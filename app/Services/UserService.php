<?php

namespace App\Services;

use App\Models\User;
use App\Services\JwtService;
use App\Services\ResponseService;
use DB;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Response;


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
        $user = User::select()
        ->where('email' , $validated['email'])
        ->first();

        //check user existing
        if (!$user){
            return ResponseService::MakeResponse(401 , 'User tidak ditemukan');
        }    
        
        //verifying hashing password
        if (!password_verify($validated['password'] , $user->password)){
            return ResponseService::MakeResponse(402 , 'Kata sandi salah');
        }


        //bikin payload buat jwt service
        $payload = [
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $validated['email']
        ];

        $token = JwtService::GenerateJwt($payload);

        return ResponseService::MakeResponse(200 , 'login success' , $user , 'success');

    }

    /**
     * Handling request register logic
     * @param Request $request
     * @return void
     */
    public function registerService(Request $request){

        //validated
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'no_telepon' => 'required|min:8',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
        ]);

        
        //cek email 
        $emailexist = User::where('email', $validated['email'])->first();

        if ($emailexist)
        {
            return ResponseService::MakeResponse(402 , 'Email was exist');
        }
        

        //store to database

        try {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'no_telp' => $validated['no_telepon'],
                'password' => password_hash($validated['password'] , PASSWORD_DEFAULT)
            ]);

        }
        catch(Exception $e){
            return ResponseService::MakeResponse(402 , 'Input not valid');
        }

        //Buat payload 
        $payload = [
            'id' => $user->id,
            'nama' => $user->name ,
            'email' => $user->email
        ];

        //generate jwt
        $token = JwtService::GenerateJwt($payload);


        //success responses 
        return ResponseService::MakeResponse(200 , 'Register Success' , $user, 'success' , $token);
    }


    /**
     * Handling request user update logic 
     * @param Request $request
     * @return void
     */
    public function updateService(Request $request){
        //validasi 
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|numeric|digits_between:8,20'
        ]);
        
        //update database 
            try {
                $user = User::find(auth()->user()->id);
                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->no_telp = $validated['phone'];
                $user->save();
            }
            catch(Exception $e){
                return ResponseService::MakeResponse(500 , 'Email atau nomor telepon sudah digunakan');
            }
    
            return ResponseService::MakeResponse(200 , 'Edit data berhasil' , $user , 'success');

    }


}
