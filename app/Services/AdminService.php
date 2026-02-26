<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Team;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Function_;
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

    public function GetInfoTeam()
    {

        $data = Document::join('teams', 'document.team_id', '=', 'teams.id')
            ->selectRaw('COUNT(status_document) as jumlah, status_document')
            ->groupBy('status_document')
            ->get();

        $total = Team::select('id')->count();

        $pending = $data->where('status_document', 'pending')->count();
        $approved = $data->where('status_document', 'approved')->count();
        $rejected = $data->where('status_document', 'rejected')->count();


        return [
            'total' => $total,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected
        ];
    }

    public function GetTeams($search = null)
    {
        $documents = Document::from('document as d') // Pastikan nama tabel di DB memang 'document', bukan 'documents'
            ->select(
                'd.*',
                't.team_name',
                't.institution',
                't.status_team',
                'u.name as ketua_name', // Beri alias agar tidak bentrok jika tabel document punya kolom 'name'
                'u.email'               // Koma berlebih di sini sudah dihapus
            )
            ->join('teams as t', 'd.team_id', '=', 't.id')
            ->join('users as u', 't.user_id', '=', 'u.id')

            // 1. Logika Pencarian (Search)
            ->when($search, function ($query, $search) {
                // Gunakan nested where (function) agar pencarian OR tidak merusak query utama
                return $query->where(function ($q) use ($search) {
                    $q->where('t.team_name', 'like', "%{$search}%")
                        ->orWhere('t.institution', 'like', "%{$search}%");
                });
            })

            ->latest('d.created_at') // Opsional: Tampilkan data yang paling baru disubmit di urutan teratas
            ->paginate(10); // Eksekusi query dengan 10 data per halaman

        return $documents;
    }

    public function Accepted(Request $request)
    {

        try {
            $teamId = $request->team_id;
            $document = Document::where('team_id', $teamId)->first();
            $document->status_document = 'approved';
            $document->save();

            Team::where('id', $document->team_id)->update([
                'status_team' => true
            ]);

        } catch (Exception $e) {
            return ResponseService::MakeResponse(500, 'Update galat');
        }

        return ResponseService::MakeResponse(200, 'Team telah diverifikasi', status: 'success');

    }

    public function Rejected(Request $request)
    {

        try {
            $teamId = $request->team_id;
            $alasanPenolakan = $request->alasan_penolakan;

            $document = Document::where('team_id', $teamId)->first();
            $document->status_document = 'rejected';
            $document->alasan_ditolak = $alasanPenolakan;
            $document->has_payed = false;
            $document->save();

            Team::where('id', $document->team_id)->update([
                'status_team' => false
            ]);

        } catch (Exception $e) {
            return ResponseService::MakeResponse(500, 'Update galat');
        }

        return ResponseService::MakeResponse(200, 'Team telah ditolak', status: 'success');

    }

    public function GetTeamList(Request $request)
    {
        $search = $request->input('search');

        // Query Data
        $teams = Team::with(['user', 'member']) // Pastikan eager loading agar tidak N+1 problem
            ->when($search, function ($query, $search) {
                // Logika pencarian: cari berdasarkan nama tim atau instansi
                return $query->where('team_name', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%");
            })
            ->paginate(10);
        return $teams;
    }

    public function DeleteTeam($id)
    {
        // 1. Cari document berdasarkan team_id
        $document = Document::where('team_id', $id)->first();

        // 2. Cek apakah dokumen ditemukan
        if ($document && $document->document_path) {
            // Hapus file fisik di storage/app/public/
            // Pastikan value $document->document_path berformat seperti 'documents/nama_file.pdf'
            Storage::disk('public')->delete($document->document_path);

            // Opsional: Hapus juga data dokumen dari tabel documents (jika tidak menggunakan cascade delete)
            // $document->delete(); 
        }

        // 3. Hapus team dari database
        DB::table('teams')->delete($id);

        return ResponseService::MakeResponse(200, 'Team Berhasil dihapus', status: 'Success');
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
