<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class AdminController extends Controller
{
    //
    public function dashboard(AdminService $service){
        $data = $service->GetInfoTeam();
        return view('admin.dashboard.dashboard', compact('data'));
    }

    public function verifikasi(AdminService $service){
        $data = $service->GetTeams();
        return view('admin.dashboard.verifikasi', compact('data'));
    }

    public function updateStatus(Request $request, AdminService $service){
        $response = $service->Accepted($request);

        if (!$response['status']){
            return redirect()->back()->with('error', $response['message']);
        }

        return redirect()->back()->with('success', $response['message']);

    }

    public function rejectDocument(Request $request, AdminService $service){
        
        $response = $service->Rejected($request);

        if (!$response['status']){
            Alert::error('Error', $response['message']);
            return redirect()->back()->with('error', $response['message']);
        }

        Alert::success('Success', $response['message']);
        return redirect()->back()->with('success', $response['message']);
    }   
}
