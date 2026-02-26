<?php

namespace App\Http\Controllers\ApiController;

use App\Exports\KaryaExport;
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

    public function verifikasi(Request $request ,AdminService $service)
    {
        $data = $service->GetTeams($request->input('search'));
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

    public function teamView(Request $request ,  AdminService $service)
    {
        $data = $service->GetTeamList($request);
        return view('admin.dashboard.team', compact('data'));
    }

    public function exportData(){
        return Excel::download(new TeamsExport() , 'Data_Peserta_Web_Dev.xlsx');
    }

    public function exportKarya(){
        return Excel::download(new KaryaExport() , 'Karya_Web_Development.xlsx');
    }

    public function deleteTeam(string $id , AdminService $service){
        $response = $service->DeleteTeam($id);
        if (!$response['status']){
            Alert::error('Error' , $response['message']);
            return redirect()->back();
        }
        Alert::success('Success' , $response['message']);
        return redirect()->back();
    }

    public function karyaView(AdminService $service){
        $data = $service->GetListKarya();
        return view('admin.dashboard.karya' , compact('data'));
    }

}
