<?php

use App\Http\Controllers\ApiController\AdminController;
use App\Http\Controllers\ApiController\TeamController;
use App\Http\Controllers\ApiController\UserController;
use App\Http\Controllers\biodataController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Models\ResetToken;
use App\Route\Router;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/login', function () {
        return redirect()->route('login.view');
    })->name('loginAdmin');
    Route::post('/login', function () {
        return redirect()->route('login.view');
    })->name('login');

    Route::middleware(AdminMiddleware::class)->group(function() {

        Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    
        Route::get('/verifikasi', [AdminController::class, 'verifikasi'])->name('verifikasi');
    
        Route::get('/team', [AdminController::class , 'teamView'])->name('team');
    
        Route::get('/karya', [AdminController::class , 'karyaView'])->name('karya');
    
        Route::get('/export', [AdminController::class , 'exportData'])->name('export');
        Route::get('/exportKarya' , [AdminController::class , 'exportKarya'])->name('exportKarya');
    
        Route::get('/deleteTeam/{id}' , [AdminController::class , 'deleteTeam'] );
    
        Route::post('/updateStatus', [AdminController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/rejectDocument', [AdminController::class, 'rejectDocument'])->name('rejectDocument');
        Route::post('/logout' , [AdminController::class , 'logout'])->name('logout');
    });

});

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/editProfile', function () {
        return view('dashboard.dashboard.editProfile');
    })->name('editProfile');

    Route::post('/updateProfile', [UserController::class, 'update'])->name('updateProfile');

    Route::get('/addTeam', function () {
        return view('dashboard.dashboard.addTeam');
    })->name('addTeam');

    Route::get('/teamPeserta', function () {
        return view('dashboard.dashboard.teamPeserta');
    })->name('teamPeserta');

    Route::get('/dashboard', function () {
        return view('dashboard.dashboard.dashboard');
    })->name('dashboard');

    Route::get('/contact', function () {
        return view('dashboard.dashboard.contactPerson');
    })->name('contact');

    Route::get('/uploadKarya', function () {
        $team = auth()->user()->team;
        if (!$team || !$team->status_team) {
            Alert::warning('Akses Terkunci', 'Pembayaran anda belum terverifikasi oleh admin. Silakan selesaikan pembayaran terlebih dahulu.');
            return redirect()->route('teamPeserta');
        }
        return view('dashboard.dashboard.uploadKarya');
    })->name('uploadKarya');

    Route::post('/uploadDocument', [TeamController::class, 'UploadDocument'])->name('uploadDocument');
    Route::post('/uploadKarya', [TeamController::class , 'UploadKarya'])->name('uploadKarya');
    Route::get('/haspay' , [TeamController::class , 'Payment'])->name('hasPayment');
    Route::post('/cancelPayment', [TeamController::class , 'CancelPayment'])->name('cancelPayment');
    Route::post('/deleteDocument', [TeamController::class , 'DeleteDocument'])->name('deleteDocument');
});

Route::get('/', function () {
    return view('beranda'); 
})->name('beranda');

Route::post(Router::$registParam, [UserController::class, 'register'])->name('register');
Route::post(Router::$registTeamParam, [TeamController::class, 'register'])->name('registerTeam');

Route::post(Router::$loginParam, [UserController::class, 'login'])->name('login');
Route::post(Router::$logoutParam, [UserController::class, 'logout'])->name('logout');

Route::get(Router::$registParam, function () {
    return view('auth.auth.register');
})->name('register.view');

Route::get(Router::$loginParam, function () {
    return view('auth.auth.login');
})->name('login.view');



Route::get('/forgot-password', function () {
    return view('auth.auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [UserController::class, 'sendResetLink'])->name('forgotpassword');
Route::post('/reset-password' , [UserController::class, 'resetPassword'])->name('reset-password');

Route::get('/reset-password/{token}', function ($token) {
    $res_token = ResetToken::where('token' , $token)->first();
    if (!$res_token)
    {
        Alert::error('Error' , 'Token not found');
        return redirect()->route('login');
    }
    return view('auth.auth.reset-password', ['token' => $token , 'email' => $res_token->email]);
})->name('password.reset');


Route::get('/verify-email', function () {
    return view('auth.auth.verify-email');
})->name('verification.notice');

Route::post('/verify-email' , [UserController::class , 'verifyEmail'])->name('verify_email');
Route::post('/resend_otp' , [UserController::class , 'resendOtp'])->name('resend_otp');
Route::post('/send_question' , [UserController::class , 'sendQuestion'])->name('send_question');