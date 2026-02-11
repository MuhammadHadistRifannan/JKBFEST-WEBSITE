<?php

use Faker\Guesser\Name;
use Illuminate\Http\Request;
use PhpParser\Node\Name as NodeName;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use RealRashid\SweetAlert\Facades\Alert;



Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email',
        'no_telepon' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    Alert::success('Pendaftaran Berhasil!', 'Akun Anda telah berhasil dibuat.');
    return back();
});
Route::get('/register', function () {
    return view('auth.auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.auth.login');
})->name('login');

Route::get('/editProfile', function () {
    return view('dashboard.dashboard.editProfile');
})->name('editProfile');

Route::get('/addTeam', function () {
    return view('dashboard.dashboard.addTeam');
})->name('addTeam');

Route::get('/teamPeserta', function () {
    return view('dashboard.dashboard.teamPeserta');
})->name('teamPeserta');

Route::get('/dashboard', [TestController::class, 'dashboard'])->name('dashboard');

Route::get('/contact', function () {
    return view('dashboard.dashboard.contactPerson');
})->name('contact');

Route::get('/uploadKarya', function () {
    return view('dashboard.dashboard.uploadKarya');
})->name('uploadKarya');
