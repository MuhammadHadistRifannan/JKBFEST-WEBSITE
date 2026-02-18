<?php

namespace App\Services\UserService;

use App\Services\JwtService;
use App\Services\ResponseService\ResponseService;
use DB;
use Exception;
use Illuminate\Http\Request;


class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handling request login logic
     * @param Request $request
     * @return void
     */
    public function loginService(Request $request){
        //validate
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
        ]);

        //read database
        $user = DB::table('users')
        ->where('email' , $validated['email'])
        ->first();

        //check user existing
        if (!$user){
            return response()->json(['message' => 'user tidak ditemukan' , 'status' => null], 404);
        }    
        
        //verifying hashing password
        if (!password_verify($validated['password'] , $user->password)){
            return response()->json(['message' => 'email atau password salah' , 'status' => null] , 401);
        }


        //bikin payload buat jwt service
        $payload = [
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $validated['email']
        ];

        $token = JwtService::GenerateJwt($payload);

        return ResponseService::MakeResponse(200 , 'login success' , $payload , 'success');

    }

    /**
     * Handling request register logic
     * @param Request $request
     * @return void
     */
    public function registerService(Request $request){

        //validated
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'no_telp' => 'required|min:8',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
        ]);

        //cek email 
        $emailexist = DB::table('users')->where('email' , $validated['email']);
        

        //store to database

        try {
    
            $userId = DB::table('users')->insertGetId([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'no_telp'=> $validated['no_telp'],
                'password' => password_hash($validated['password'] , PASSWORD_DEFAULT)
            ]);

        }
        catch(Exception $e){
            return response()->json($e->getMessage());
        }

        //Buat payload 
        $payload = [
            'id' => $userId,
            'nama' => $validated['nama'] ,
            'email' => $validated['email']
        ];

        //generate jwt
        $token = JwtService::GenerateJwt($payload);

        //success responses 
        return ResponseService::MakeResponse(200 , 'Register Success' , $payload, 'success' , $token);
    }


}
