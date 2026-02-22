<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamMember;
use Exception;
use Illuminate\Http\Request;


class TeamService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function RegisterTeam(Request $request){
        
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
              'advisor_name' => $validated['advisor_name']  ,
              'advisor_phone' => $validated['advisor_phone'] , 
              'status_team' => false,
              'status_document' => false,
            ]);


            // Create many member 
            $member = [];
            $member[] = [
                'name' => $validated['member_1_name'],
                'phone' => $validated['member_1_phone']
            ];

            if (!empty($validated['member_2_name'])){
                $member[] = [
                    'name' => $validated['member_2_name'],
                    'phone' => $validated['member_2_phone']
                ];
            }

            $team->member()->createMany($member);

        }catch (Exception $e){
            dd($e->getMessage());
            return ResponseService::MakeResponse(500 , $e->getMessage());
        }

        return ResponseService::MakeResponse(200 , 'Daftar Team Success' , $team , 'success');

    }
}
