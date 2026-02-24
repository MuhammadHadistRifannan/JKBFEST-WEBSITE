<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;
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

        $documents = Document::all();

        $count = $documents->count();
        $pending = $documents->where('status_document', 'pending')->count();
        $approved = $documents->where('status_document', 'approved')->count();
        $rejected = $documents->where('status_document', 'rejected')->count();

        return [
            'total' => $count,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected
        ];
    }

    public function GetTeams()
    {
        /**
         * select * from document join teams on document.team_id = 1
         * Joining table document and teams for get all team with their document and status document
         */
        $documents = Document::from('document as d') // Memberikan alias 'd' untuk tabel document
            ->select(
                'd.*',                 // Ambil semua kolom dari tabel document
                't.team_name',         // Ambil nama tim dari tabel teams
                't.institution',       // Ambil institusi dari tabel teams
                't.status_team',   // Ambil status tim dari tabel teams
                'u.name',
                'u.email',
            )
            ->join('teams as t', 'd.team_id', '=', 't.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->get(); // Eksekusi query

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
            $document->save();

            Team::where('id', $document->team_id)->update([
                'status_team' => false
            ]);

        } catch (Exception $e) {
            return ResponseService::MakeResponse(500, 'Update galat');
        }

        return ResponseService::MakeResponse(200, 'Team telah ditolak', status: 'success');

    }

    public function GetTeamList()
    {
        $teams = Team::with(['user', 'member'])->paginate(5);
        return $teams;
    }

    
}
