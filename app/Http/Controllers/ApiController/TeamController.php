<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Services\JwtService;
use App\Enum\StatusTeam;
use App\Services\TeamService;
use DB;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use function PHPUnit\Framework\isNumeric;

class TeamController extends Controller
{


    /**
     * MEMBUAT TEAM BARU
     */
    public function register(Request $request , TeamService $service)
    {
        $response = $service->RegisterTeam($request);

        if (!$response['status']){
            Alert::error('Error' , $response['message']);
            return redirect()->back()->withInput();
        }

        $team = $response['data'];
        return redirect()->route('dashboard');
    }

    public function UploadDocument(Request $request , TeamService $service){
        $response = $service->UploadDocument($request);

        if (!$response['status']){
            Alert::error('Error' , $response['message']);
            return redirect()->back()->withInput();
        }

        Alert::success('Success' , $response['message']);
        return redirect()->route('teamPeserta');
    }


}
