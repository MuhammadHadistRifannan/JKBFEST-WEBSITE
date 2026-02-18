<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Http;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct() {
        $this->api = env('APP_URL');
    }
    public function login(){
        $data = request();
        $response = Http::post($this->api . '/api/user/login' , [
            'email' => $data->email,
            'password' => $data->password
        ]);

        if (!$response->forbidden()){
            echo $response['message'];
        }

        echo $response['message'];
    }
}
