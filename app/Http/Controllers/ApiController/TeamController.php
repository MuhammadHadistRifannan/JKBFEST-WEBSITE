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
        Alert::success('Success' , $response['message']);
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

    public function Payment(Request $request, TeamService $service){
        $response = $service->HasPayment();

        // If called via AJAX (expects JSON), return JSON response
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json($response);
        }

        if (!$response['status']){
            Alert::alert('Galat' , $response['message']);
            return redirect()->back();
        }

        Alert::success('Success' , $response['message']);
        return redirect()->back(); 
    }

    public function CancelPayment(Request $request, TeamService $service){
        $response = $service->CancelPayment();

        if (!$response['status']){
            Alert::alert('Galat' , $response['message']);
            return redirect()->back();
        }

        Alert::success('Berhasil' , $response['message']);
        return redirect()->back();
    }

    public function UploadKarya(Request $request , TeamService $service){
        $response = $service->UploadKarya($request);

        if (!$response['status']){
            Alert::alert('Alert' , $response['message']);
            return redirect()->back();
        }

        Alert::success('Success' , $response['message']);
        return redirect()->back();
    }

    public function DeleteDocument(Request $request, TeamService $service)
    {
        $response = $service->DeleteDocument();
        if (!$response['status']) {
            Alert::error('Gagal', $response['message']);
            return redirect()->back();
        }

        Alert::success('Berhasil', $response['message']);
        return redirect()->back();
    }


}
