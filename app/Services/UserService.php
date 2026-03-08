<?php

namespace App\Services;

use App\Mail\SendMail;
use App\Models\ResetToken;
use App\Models\User;
use App\Services\ResponseService;
use DB;
use Exception;
use Illuminate\Http\Request;
use Mail;
use Ramsey\Uuid\Guid\Guid;
use RealRashid\SweetAlert\Facades\Alert;
use Response;
use Str;


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
                'password' => password_hash($validated['password'] , PASSWORD_DEFAULT),
                'role' => 0
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


        //success responses 
        return ResponseService::MakeResponse(200 , 'Register Success' , $user, 'success');
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

    public function SendResetPassword(Request $request){
        $validated = $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email' , $validated['email'])->first();
        if (!$user){
            return ResponseService::MakeResponse(402 , 'Email not found');
        }
        
        //Generate new token 
        $token = str_replace('-', '' , (string) Str::uuid());
        
        //Send Email And Token
        try {
            Mail::to($validated['email'])->send(new SendMail($token));
            ResetToken::insert([
                'email' => $validated['email'],
                'token' => $token
            ]);
        }catch(Exception $e){
            return ResponseService::MakeResponse(401 , $e->getMessage());
        }

        return ResponseService::MakeResponse(200 , 'Silahkan cek email anda' , null , 'success');

    }

    public function ResetPassword(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/',
            'password_confirmation' => 'required|same:password',
            'token' => 'required'
        ]);

        $hashed = password_hash($validated['password'] , PASSWORD_DEFAULT);
        try {
            $user = User::where('email' , $validated['email'])->first();
            $user->update([
                'password' => $hashed
            ]);
            $user->save();

            ResetToken::where('token' , $validated['token'])->delete();
            
        }catch(Exception $e){
            return ResponseService::MakeResponse(401 , $e->getMessage());
        } 

        return ResponseService::MakeResponse(200 , 'Password Berhasil diganti , Silahkan login kembali' , null , 'success');
    }


}
