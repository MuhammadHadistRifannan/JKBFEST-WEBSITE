<?php

namespace App\Services\ResponseService;

class ResponseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Wrapping response to a single wrap 
     * @param mixed $httpCode
     * @param mixed $message
     * @param mixed $data
     * @return void
     */
    public static function MakeResponse($httpCode , $message , $data = null , $status = null , $token = null){
        
        if ($token != null){
            return [
                'message' => $message,
                'data' => $data,
                'token' => $token,
                'status' => $status,
                'httpcode' => $httpCode
            ];
        }
        
        return [
            'message' => $message,
            'data' => $data,
            'status' => $status,
            'httpcode' => $httpCode
        ];
    }
}
