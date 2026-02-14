<?php

namespace App\Http\Controllers;

use App\UserDto;
use DB;
use Exception;
use Illuminate\Http\Request;
use Password;

class UserController extends Controller
{
    
    /**
     * LOGIN USER
     * @param Request $request
     * @return void
     */
    public function login(Request $request){
        
        //validate 
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
        ]);
        
        //read database 
        $user = DB::table('users')
        ->where('email' , $validated['email'])
        ->first();
        
        if (!$user){
            return response()->json(['message' => 'user tidak ditemukan' , 'status' => null], 404);
        }        

        //verifying password 
        if (!password_verify($validated['password'] , $user->password)){
            return response()->json(['message' => 'email atau password salah' , 'status' => null] , 401);
        }


        return response()->json([
            'message' => 'Berhasil Login'
        ]);
    }
    /**
     * REGISTER USER.
     */
    public function store(Request $request)
    {
        //validate

         $validated = $request->validate([
            'nama' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'no_telp' => 'required|min:8',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
        ]);

        //store to database

        try {
    
            DB::table('users')->insert([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'no_telp'=> $validated['no_telp'],
                'password' => password_hash($validated['password'] , PASSWORD_DEFAULT)
            ]);

        }
        catch(Exception $e){
            return response()->json($e->getMessage());
        }
    

        //success responses 
        return response()->json([
            'data' => $validated
        ]);
    }

    /**
     *  GET USER BY ID
     */
    public function show(string $id)
    {
        //validate type
        if (!is_numeric($id)){return response()->json(['message'=>'id harus integer' , 'status' => null]);}

        $user = DB::table('users')
                ->where('id' , $id)
                ->first();
        if (!$user){
            return response()->json(['message' => 'user tidak ditemukan' , 'status'=> null]);
        }
        
        $dto = new UserDto();
        $dto->MapUser($user->name , $user->email , $user->no_telp);

        return response()->json([
            'data' => $dto
        ]);

    }


    /**
     * UPDATE USER BY ID
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * DELETE USER BY ID 
     */
    public function destroy(string $id)
    {
        //
    }

}
