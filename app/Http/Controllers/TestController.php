<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.dashboard.dashboard');
    }
}
