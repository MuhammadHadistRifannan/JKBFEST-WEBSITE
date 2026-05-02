<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class UserDashboardController extends Controller
{
    //

    protected $preservedRoute;

    public function __construct() {
        $this->preservedRoute = [
            'teamPeserta',
            'addTeam',
            'uploadKarya'
        ];
    }

    public function index(){
        return view('dashboard.dashboard.dashboard');
    }

    public function addTeam(){
        return view('dashboard.dashboard.addTeam');
    }

    public function teamPeserta(){
        return view('dashboard.dashboard.teamPeserta');
    }

    public function uploadKarya(){
        return view('dashboard.dashboard.uploadKarya');
    }
}
