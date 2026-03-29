<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Documents;
use App\Models\Penghasilan;
use App\Models\SpecialUser;
use App\Models\Team;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Response;

class AdminService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function loginService(Request $request){
        //validation special user
        $validated = $request->validate([
            'email' => 'required|email|max:30',
            'password' => 'required'
        ]);
        
        $user = SpecialUser::where('email' , $validated['email'])->first();
        if ($user){
            $password_hash = password_verify($validated['password'] , $user->password);
            if (!$password_hash){
                return ResponseService::MakeResponse(401 , 'Wrong Password');
            }
        }
        else {
            return ResponseService::MakeResponse(402,'User not Found');
        }

        session([
            'special_user' => $user
        ]);
        
        return ResponseService::MakeResponse(200 , 'Login Admin Berhasil' , null , 'success');
    }

    public function GetInfoTeam()
    {
        // Perbaikan: Menggunakan nama tabel jamak 'documents' sesuai standar Laravel
        $data = Documents::join('teams', 'documents.team_id', '=', 'teams.id')
            ->selectRaw('COUNT(documents.status_document) as jumlah, documents.status_document')
            ->groupBy('documents.status_document')
            ->get();

        $total = Team::count(); // Lebih ringkas

        // Perbaikan: Mengambil nilai kolom 'jumlah' dari hasil query, bukan menghitung jumlah baris
        $pending = $data->where('status_document', 'pending')->first()->jumlah ?? 0;
        $approved = $data->where('status_document', 'approved')->first()->jumlah ?? 0;
        $rejected = $data->where('status_document', 'rejected')->first()->jumlah ?? 0;

        return [
            'total' => $total,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected
        ];
    }

    public function GetTeams($search = null, $statusFilter = null)
    {
        // 1. Bersihkan spasi
        $search = $search ? trim($search) : null;

        // 2. Hitung total data untuk sidebar
        $totalAll = Documents::count();
        $totalPending = Documents::where('status_document', 'pending')->count();
        $totalRejected = Documents::where('status_document', 'rejected')->count();
        $totalApproved = Documents::where('status_document', 'approved')->count();

        // 3. Query Utama
        // Perbaikan: Menggunakan nama tabel jamak 'documents'
        $documents = Documents::from('documents as d')
            ->select(
                'd.*',
                't.team_name',
                't.institution',
                't.status_team',
                'u.name as ketua_name', 
                'u.email'               
            )
            ->join('teams as t', 'd.team_id', '=', 't.id')
            ->join('users as u', 't.user_id', '=', 'u.id')

            ->when($search, function ($query, $search) {
                return $query->whereRaw('LOWER(t.team_name) LIKE ?', ['%' . strtolower($search) . '%']);
            })

            ->when($statusFilter && $statusFilter !== 'all', function ($query) use ($statusFilter) {
                return $query->where('d.status_document', $statusFilter);
            })

            ->paginate(10)->withQueryString(); 

        // 4. Return array data murni
        return [
            'documents'     => $documents,
            'totalAll'      => $totalAll,
            'totalPending'  => $totalPending,
            'totalRejected' => $totalRejected,
            'totalApproved' => $totalApproved
        ];
    }

    public function Accepted(Request $request)
    {
        try {
            $teamId = $request->team_id;
            $document = Documents::where('team_id', $teamId)->first();

            // Perbaikan: Mencegah Null Pointer Exception jika dokumen tidak ada
            if (!$document) {
                return ResponseService::MakeResponse(404, 'Dokumen tim tidak ditemukan');
            }

            $document->status_document = 'approved';
            $document->save();

            Team::where('id', $document->team_id)->update([
                'status_team' => true
            ]);

            Penghasilan::insert([
                'uang_masuk' => 70000
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage()); // Catat error ke file log Laravel
            return ResponseService::MakeResponse(500, 'Server Error');
        }

        return ResponseService::MakeResponse(200, 'Team telah diverifikasi', status: 'success');
    }

    public function Rejected(Request $request)
    {
        try {
            $teamId = $request->team_id;
            $alasanPenolakan = $request->alasan_penolakan;

            $document = Documents::where('team_id', $teamId)->first();

            // Perbaikan: Mencegah Null Pointer Exception
            if (!$document) {
                return ResponseService::MakeResponse(404, 'Dokumen tim tidak ditemukan');
            }

            $document->status_document = 'rejected';
            $document->alasan_ditolak = $alasanPenolakan;
            $document->has_payed = false;
            
            if ($document->document_path) {
                Storage::disk('public')->delete($document->document_path);
            }
            $document->document_path = '';

            $document->save();

            Team::where('id', $document->team_id)->update([
                'status_team' => false
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseService::MakeResponse(500, 'Server Error');
        }

        return ResponseService::MakeResponse(200, 'Team telah ditolak', status: 'success');
    }

    public function GetTeamList(Request $request)
    {
        $search = $request->input('search');

        // Query Data
        $teams = Team::with(['user', 'member']) 
            ->when($search, function ($query, $search) {
                return $query->where('team_name', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%");
            })
            ->paginate(10);
            
        return $teams;
    }

    public function DeleteTeam($id)
    {
        try {
            // 1. Cari document berdasarkan team_id
            $document = Documents::where('team_id', $id)->first();

            // 2. Cek apakah dokumen ditemukan
            if ($document && $document->document_path) {
                Storage::disk('public')->delete($document->document_path);
                $document->delete(); 
            }

            // 3. Hapus team dari database
            DB::table('teams')->delete($id);

            return ResponseService::MakeResponse(200, 'Team Berhasil dihapus', status: 'Success');
            
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseService::MakeResponse(500, 'Gagal menghapus team');
        }
    }

    public function GetListKarya()
    {
        $data = Team::select([
            'team_name',
            'waktu_submit',
            'link_karya'
        ])->where('link_karya', '!=', null)->get();
        
        return $data;
    }
}