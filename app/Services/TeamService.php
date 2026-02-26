<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;
use Validator;


class TeamService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function RegisterTeam(Request $request)
    {

        //validate 
        $validated = $request->validate([
            'team_name' => 'required|max:100',
            'institution' => 'required|max:100',
            'advisor_name' => 'required|max:100',
            'advisor_phone' => 'required|max:100',
            'member_1_name' => 'required|max:100',
            'member_1_phone' => 'required|max:100',
            'member_2_name' => 'nullable|max:100',
            'member_2_phone' => 'nullable|required_with:member_2_name|max:100'
        ]);

        //add team to db 
        try {

            $team = Team::create([
                'user_id' => auth()->user()->id,
                'team_name' => $validated['team_name'],
                'institution' => $validated['institution'],
                'advisor_name' => $validated['advisor_name'],
                'advisor_phone' => $validated['advisor_phone'],
                'status_team' => false,
                'status_document' => false,
            ]);


            // Create many member 
            $member = [];
            $member[] = [
                'name' => $validated['member_1_name'],
                'phone' => $validated['member_1_phone']
            ];

            if (!empty($validated['member_2_name'])) {
                $member[] = [
                    'name' => $validated['member_2_name'],
                    'phone' => $validated['member_2_phone']
                ];
            }

            $team->member()->createMany($member);

        } catch (Exception $e) {
            dd($e->getMessage());
            return ResponseService::MakeResponse(500, $e->getMessage());
        }

        return ResponseService::MakeResponse(200, 'Daftar Team Success', $team, 'success');

    }

    public function UploadDocument(Request $request)
    {
        // 1. Gunakan Validator Manual agar tidak auto-redirect
        $validator = Validator::make($request->all(), [
            'document_file' => 'required|file|mimes:pdf|max:20480',
        ]);

        
        if ($validator->fails()) {
            return ResponseService::MakeResponse(422, 'Validasi gagal, pastikan file PDF dan maksimal 20MB.', $validator->errors());
        }

        // 2. Cek Database DULU sebelum upload file (Mencegah file sampah)
        $team = Team::where('user_id', auth()->user()->id)->first();

        if (!$team) {
            return ResponseService::MakeResponse(404, 'Team tidak ditemukan');
        }

        // 3. Jika Team ada, baru kita Upload File
        $file = $request->file('document_file');
        $filePath = $file->store('documents', 'public');

        // 4. Lakukan proses Update Database di dalam SATU blok Try-Catch
        try {
            // Update Team
            $document = Document::create([
                'team_id' => $team->id,
                'document_path' => $filePath,
                'status_document' => 'pending',
                'has_payed' => false
            ]);


            return ResponseService::MakeResponse(200, 'Dokumen berhasil diunggah', ['file_path' => $filePath], 'success');

        } catch (Exception $e) {
            // Jika gagal update database, HAPUS file yang sudah telanjur terupload agar tidak jadi sampah
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Kembalikan response error tanpa dd()
            return ResponseService::MakeResponse(500, 'Gagal mengunggah dokumen: ' . $e->getMessage());
        }
    }

    public function HasPayment(){
        $team_id = auth()->user()->team->id; 
        // add payment 
        $document = Document::where('team_id' , $team_id)->first();

        $document->has_payed = true;
        $document->save();

        if (!$document){
            return ResponseService::MakeResponse(401 , 'Upload dokumen team terlebih dahulu , disertai bukti pembayaran');
        }

        $document->update([
            'has_payed' => true
        ]);

        return ResponseService::MakeResponse(200 , 'Pembayaran Berhasil , Selanjutnya akan dicek oleh panitia', status: 'Success');
    }

    public function UploadKarya(Request $request){
        //link karya 
        $team_id = auth()->user()->team->id;
        $team = Team::where('id' , $team_id)->first();

        if (!$team){
            return ResponseService::MakeResponse(401, 'Karya tidak bisa dikumpulkan');
        }

        $team->link_karya = $request->link_karya; 
        $team->waktu_submit = now()->locale('id')->isoFormat('D MMMM Y, HH:mm [WIB]');
        $team->save();

        return ResponseService::MakeResponse(200 , 'Karya telah dikumpulkan' , status: 'success');

    }
}
