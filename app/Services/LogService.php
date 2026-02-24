<?php

namespace App\Services;

use App\Models\Logs;
use Response;
use function GuzzleHttp\default_ca_bundle;

class LogService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function addLog($action , $description){
        $log = Logs::insertOrIgnore([
            'action' => $action ,
            'description' => $description,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return $log;
    }

    public function UpdateStatusLog($action , $description){
        $this->addLog($action , $description);
        return ResponseService::MakeResponse(500 , 'Update Success');
    }

    public function GetRecentLogs(){
        $logs = Logs::paginate(5);
        return $logs;
    }

    
}
