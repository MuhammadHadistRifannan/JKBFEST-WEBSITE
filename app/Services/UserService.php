<?php

namespace App\Services;

use App\Mail\SendMail;
use App\Mail\SendOtpMail;
use App\Mail\SendResetMail;
use App\Models\EmailVerification;
use App\Models\ResetToken;
use App\Models\User;
use App\Services\ResponseService;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use DB;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Log;
use Mail;
use Ramsey\Uuid\Guid\Guid;
use RateLimiter;
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
    public function loginService(Request $request)
    {
        //validate
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        //read database
        $user = User::select()
            ->where('email', $validated['email'])
            ->first();

        //check user existing
        if (!$user) {
            return ResponseService::MakeResponse(401, 'User tidak ditemukan');
        }

        //verifying hashing password
        if (!Hash::check($validated['password'], $user->password)) {
            return ResponseService::MakeResponse(402, 'Kata sandi salah');
        }

        return ResponseService::MakeResponse(200, 'login success', $user, 'success');

    }

    /**
     * Handling request register logic
     * @param Request $request
     * @return void
     */
    public function registerService(Request $request)
    {

        //validated
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'no_telepon' => 'required|min:8',
            'password' => 'required|min:8'
        ]);


        //cek email 
        $emailexist = User::where('email', $validated['email'])->exists();

        if ($emailexist) {
            return ResponseService::MakeResponse(402, 'Email was exist');
        }


        $response = $this->SendOtp($validated);

        if (!$response['status'])
            return ResponseService::MakeResponse(401, 'Otp Failed Send');


        //success responses 
        return ResponseService::MakeResponse(200, 'Send Otp Success', $validated, 'success');
    }

    public function registUser(Request $request)
    {
        $otp = implode('', $request->input('otp'));

        try {

            DB::beginTransaction();

            // cek OTP
            $verification = EmailVerification::where('email', $request->email)
                ->where('otp', $otp)
                ->where('verified', false)
                ->first();

            if (!$verification) {
                return ResponseService::MakeResponse(401, 'OTP tidak valid');
            }

            // buat user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'no_telp' => $request->no_telepon,
                'password' => Hash::make($request->password),
                'role' => 0
            ]);

            // update verifikasi
            $verification->update([
                'verified' => true
            ]);

            DB::commit();

            return ResponseService::MakeResponse(200, 'Registrasi berhasil', status: 'success');

        } catch (Exception $e) {

            DB::rollBack();
            Log::error($e->getMessage());

            return ResponseService::MakeResponse(402, 'Input not valid');
        }
    }


    /**
     * Handling request user update logic 
     * @param Request $request
     * @return void
     */
    public function updateService(Request $request)
    {
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
        } catch (Exception $e) {
            return ResponseService::MakeResponse(500, 'Email atau nomor telepon sudah digunakan');
        }

        return ResponseService::MakeResponse(200, 'Edit data berhasil', $user, 'success');

    }

    public function SendResetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        $limit = $this->LimitRequest($validated['email']);

        if ($limit['httpCode'] == 429){
            return $limit;
        }

        $user = User::where('email', $validated['email'])->first();
        if (!$user) {
            return ResponseService::MakeResponse(402, 'Email not found');
        }

        //Generate new token 
        $token = str_replace('-', '', (string) Str::uuid());

        //Send Email And Token
        try {
            Mail::to($validated['email'])->send(new SendResetMail($token));
            ResetToken::insert([
                'email' => $validated['email'],
                'token' => $token
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseService::MakeResponse(500, "Server Error");
        }

        return ResponseService::MakeResponse(200, 'Silahkan cek email anda', null, 'success');

    }

    public function ResetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/',
            'password_confirmation' => 'required|same:password',
            'token' => 'required'
        ]);

        $hashed = Hash::make($validated['password']);
        try {
            $user = User::where('email', $validated['email'])->first();
            $user->update([
                'password' => $hashed
            ]);
            $user->save();

            ResetToken::where('token', $validated['token'])->delete();

        } catch (Exception $e) {
            return ResponseService::MakeResponse(401, $e->getMessage());
        }

        return ResponseService::MakeResponse(200, 'Password Berhasil diganti , Silahkan login kembali', null, 'success');
    }

    public function LimitRequest($key){

        if (RateLimiter::tooManyAttempts($key , 3)){
            $seconds = RateLimiter::availableIn($key );
            return ResponseService::MakeResponse(429 , "Terlalu banyak request silahkan coba lagi dalam " . $seconds . " detik.");
        }

        RateLimiter::hit($key , 300);
        return ResponseService::MakeResponse(200 , "Request success" , status: 'Success');
    }

    public function SendOtp($data)
    {

        //generate random OTP 
        $otp = random_int(100000, 999999);
        $expires = Carbon::now()->addMinutes(5);

        $limit = $this->LimitRequest($data['email']);
        if ($limit['httpCode'] == 429){
            return $limit;
        }

        //write to database 
        try {
            $verif_data = EmailVerification::where('email', $data['email'])->first();
            if (!$verif_data) {
                EmailVerification::insert([
                    'email' => $data['email'],
                    'otp' => $otp,
                    'expired_at' => $expires
                ]);
                Mail::to($data['email'])->send(new SendOtpMail($otp));
            } else {
                if ($verif_data->isOtpExpired($data['email'])) {
                    $verif_data->update([
                        'otp' => $otp,
                        'expires_at' => now()->addMinutes(5)
                    ]);

                    Mail::to($data['email'])->send(new SendOtpMail($otp));
                    return ResponseService::MakeResponse(200, 'Sent OTP', status: 'Success');
                } else {
                    Mail::to($data['email'])->send(new SendOtpMail($verif_data->otp));
                    return ResponseService::MakeResponse(200, 'Sent OTP', status: 'Success');
                }
            }


        } catch (Exception $e) {
            return ResponseService::MakeResponse(401, 'Server Error');
        }

        return ResponseService::MakeResponse(200, 'Sent OTP', status: 'success');
    }

    

    public function ResendOtp(Request $request)
    {
        $email = $request->email;

        $limit = $this->LimitRequest($email);
        if ($limit['httpCode'] == 429){
            return $limit;
        }

        try {
            $data = EmailVerification::where('email', $email)->first();

            if (!$data) {
                $newOtp = random_int(100000, 999999);
                $expired = Carbon::now()->addMinutes(5);

                EmailVerification::insert([
                    'email' => $email,
                    'otp' => $newOtp,
                    'expired_at' => $expired
                ]);

                Mail::to($email)->send(new SendOtpMail($newOtp));
                return ResponseService::MakeResponse(200, 'Otp has sent to email', status: 'success');

            } else {
                $newOtp = random_int(100000, 999999);
                
                // Jika data sudah ada (expired atau belum), kita buat ulang OTP-nya saja agar aman
                $data->update([
                    'otp' => $newOtp,
                    'expired_at' => now()->addMinutes(5)
                ]);

                Mail::to($email)->send(new SendOtpMail($newOtp));
                return ResponseService::MakeResponse(200, 'Otp has sent to email', status: 'success');
            }

        } catch (Exception $e) {
            Log::error('ResendOtp Error: ' . $e->getMessage());
            return ResponseService::MakeResponse(401, 'Server Error: ' . $e->getMessage());
        }

    }

   


}
