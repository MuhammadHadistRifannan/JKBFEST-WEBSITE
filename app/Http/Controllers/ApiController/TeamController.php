<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Services\JwtService;
use App\Enum\StatusTeam;
use DB;
use Exception;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNumeric;

class TeamController extends Controller
{
    /**
     * MELIHAT SEMUA TEAM
     * @return void
     */
    public function index(){

    }

    /**
     * MEMBUAT TEAM BARU
     */
    public function store(Request $request)
    {
        // Validasi input 
        $validate_team = $request->validate([
            //TEAM 
            'nama_team' => 'required|min:3|max:100',
            'asal_team' => 'required|min:3|max:100',
            'pembimbing_team' => 'required|min:3|max:100',
            'no_telp_pembimbing_team' => 'required|min:3|max:100',

            //MEMBER 
            'member_1' => 'required|min:3|max:100',
            'no_telp_member_1' => 'required|min:3|max:100',
            'member_2' => 'nullable|min:3|max:100',
            'no_telp_member_2' => 'nullable|min:3|max:100'
        ]);


        try {
            
            $team = [
                'user_id' => JwtService::GetVar($request->bearerToken())->id,
                'team_name' => $validate_team['nama_team'],
                'institution' => $validate_team['asal_team'],
                'status' => StatusTeam::pending->value
            ];
            //Query buat team
            $teamId = DB::table('teams')
            ->insertGetId($team);
            
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage() , 'status' => null]);
        }

        //objek member 
        $member = [];
        $member[] = [
            'team_id' => $teamId,
            'name' => $validate_team['member_1'],
            'phone' => $validate_team['no_telp_member_1']
        ];

        if (!empty($validate_team['member_2'])){
            $member[] = [
                'team_id' => $teamId,
                'name' => $validate_team['member_2'],
                'phone' => $validate_team['no_telp_member_2']
            ];

        }

        //Query buat team member 
        DB::table('team_members')->insert($member);

        return response()->json([
            'message' => 'membuat team sukses',
            'data' => $team
        ]);

    }

    /**
     * MELIHAT DATA TEAM DARI ID KETUA
     */
    public function show(string $idketua)
    {
        //
        if (!isNumeric($idketua)) {
            return response()->json(['message' => 'id tidak valid' , 'status' => null] , 402);
        }

        //Query 
        $team = DB::table('teams')->where('user_id', $idketua)->first();
        return response()->json([
            'data' => $team,
            'status' => 'success'
        ]);
    }

    
    /**
     * UPDATE DATA TEAM
     */
    public function update(Request $request, string $team_id)
    {
        //
    }

    /**
     * HAPUS TEAM
     */
    public function destroy(string $id)
    {
        //
    }
}
