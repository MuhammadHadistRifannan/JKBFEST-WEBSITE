<?php

use App\Http\Controllers\ApiController\TeamController;
use App\Http\Controllers\ApiController\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Route\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->name('dashboard');

    Route::get('/verifikasi', function () {
        return view('admin.dashboard.verifikasi');
    })->name('verifikasi');

    Route::get('/team', function () {
        return view('admin.dashboard.team');
    })->name('team');

    Route::get('/karya', function () {
        return view('admin.dashboard.karya');
    })->name('karya');
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
        return view('dashboard.dashboard.uploadKarya');
    })->name('uploadKarya');

});

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