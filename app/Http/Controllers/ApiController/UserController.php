<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\UserService;
use App\Services\ResponseService;
use App\UserDto;
use Auth;
use DB;
use Exception;
use Illuminate\Http\Request;
use Mail;
use Password;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserController extends Controller
{

    /**
     * LOGIN USER
     * @param Request $request
     * @return void
     */
    public function login(Request $request, UserService $service)
    {
        $response = $service->loginService($request);

        if (!$response['status']) {
            Alert::error('Error', $response['message']);
            return redirect()->back()->withInput();
        }

        $user = $response['data'];
        Auth::login($user);

        $request->session()->regenerate();
        Alert::success('Success', $response['message']);

        return redirect()->route('dashboard');
    }
    /**
     * REGISTER USER.
     */
    public function register(Request $request, UserService $service)
    {
        $response = $service->registerService($request);

        if (!$response['status']) {

            Alert::error('Error', $response['message']);
            return redirect()->back()->withInput();
        }

        $data = $response['data'];

        session()->put('verification_data', $data);
        Alert::success('Success', 'OTP has sent to email');

        return redirect()->route('verification.notice');
    }

    public function verifyEmail(Request $request, UserService $service)
    {
        $response = $service->registUser($request);
        if (!$response['status']) {
            // Gunakan Session Flash secara manual sebelum redirect
            session()->put('error_verifikasi', $response['message']);

            return redirect()->back()->with('error_verifikasi' , $response['message']);
        }
        Alert::success('Success', 'Email anda telah berhasil diverifikasi');
        return redirect()->route('login');
    }

    public function resendOtp(Request $request, UserService $service)
    {
        $response = $service->ResendOtp($request);

        if (!$response['status']) {
            return response()->json([
                'status' => false,
                'message' => $response['message']
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'OTP has sent to email'
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        Alert::success('Logout', 'Logout Berhasil');
        return redirect('/login');
    }

    /**
     *  GET USER BY ID
     */
    public function show(string $id)
    {
        //validate type
        if (!is_numeric($id)) {
            return response()->json(['message' => 'id harus integer', 'status' => null]);
        }

        $user = DB::table('users')
            ->where('id', $id)
            ->first();
        if (!$user) {
            return response()->json(['message' => 'user tidak ditemukan', 'status' => null]);
        }

        $dto = new UserDto();
        $dto->MapUser($user->name, $user->email, $user->no_telp);

        return response()->json([
            'data' => $dto
        ]);

    }

    public function sendQuestion(){
        Alert::success('Success' , 'Pertanyaan anda telah terkirim');
        return redirect()->back();
    }


    /**
     * UPDATE USER BY ID
     */
    public function update(Request $request, UserService $service)
    {
        //
        $response = $service->updateService($request);

        if (!$response['status']) {
            Alert::error('Error', $response['message']);
            return redirect()->back()->withInput();
        }
        Alert::success('Success', $response['message']);
        return redirect()->route('dashboard');
    }

    /**
     * DELETE USER BY ID 
     */
    public function destroy(string $id)
    {
        //
    }

    public function sendResetLink(Request $request, UserService $service)
    {
        $response = $service->SendResetPassword($request);
        if (!$response['status']) {
            Alert::error('Error', $response['message']);
            return redirect()->back();
        }

        Alert::success('success', $response['message']);
        return redirect()->route('login');
    }

    public function resetPassword(Request $request, UserService $service)
    {
        //reset password 
        $response = $service->ResetPassword($request);
        if (!$response['status']) {
            Alert::error('Error', $response['message']);
            return redirect()->back();
        }

        Alert::success('success', $response['message']);
        ;
        return redirect()->route('login');
    }

}
