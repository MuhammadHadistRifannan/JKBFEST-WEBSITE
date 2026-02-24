<?php

namespace App\Http\Controllers\ApiController;

use App\Exports\TeamsExport;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\AdminService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
class AdminController extends Controller
{
    //
    public function dashboard(AdminService $service, LogService $logService)
    {
        $data = $service->GetInfoTeam();
        $logs = $logService->GetRecentLogs();
        return view('admin.dashboard.dashboard', compact(['data', 'logs']));
    }

    public function verifikasi(AdminService $service)
    {
        $data = $service->GetTeams();
        return view('admin.dashboard.verifikasi', compact('data'));
    }

    public function updateStatus(Request $request, AdminService $service, LogService $logService)
    {
        $response = $service->Accepted($request);

        if (!$response['status']) {
            return redirect()->back()->with('error', $response['message']);
        }

        Alert::success('Success', $response['message']);
        $logResponse = $logService->UpdateStatusLog('accepted', 'Berkas team ' . $request->team_name . ' di verifikasi admin');

        return redirect()->back()->with('success', $response['message']);

    }

    public function rejectDocument(Request $request, AdminService $service, LogService $logService)
    {

        $response = $service->Rejected($request);

        if (!$response['status']) {
            Alert::error('Error', $response['message']);
            return redirect()->back()->with('error', $response['message']);
        }

        Alert::success('Success', $response['message']);
        $logResponse = $logService->UpdateStatusLog('rejected', 'Berkas team ' . $request->team_name . ' di tolak admin');

        return redirect()->back()->with('success', $response['message']);
    }

    public function teamView(AdminService $service)
    {
        $data = $service->GetTeamList();
        return view('admin.dashboard.team', compact('data'));
    }

    public function exportData(AdminService $service){
        return Excel::download(new TeamsExport() , 'Data_Peserta_Web_Dev.xlsx');
    }

}
