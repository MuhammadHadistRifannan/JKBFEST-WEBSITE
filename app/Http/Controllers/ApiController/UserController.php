<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Services\JwtService;
use App\Services\UserService\UserService;
use App\UserDto;
use Auth;
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
    public function login(Request $request , UserService $service){
        $response = $service->loginService($request);

        if (!$response['status']) return redirect()->back()->with('error' ,$response['message']);

        $user = $response['data'];
        Auth::login($user);

        return redirect()->route('dashboard')->with('success' , 'Login Successfull');
    }
    /**
     * REGISTER USER.
     */
    public function store(Request $request , UserService $service)
    {
        $response = $service->registerService($request);
        
        if (!$response['status'])  return redirect()->back()->with('error' , $response);

        $user = $response['data']; 

        return view('dashboard.dashboard.dashboard' , compact('user'));
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
