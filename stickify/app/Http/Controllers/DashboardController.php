<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // this method will show dashboard to the user.   ** tyo tutorial ma chai dashboard lai index bhanera deko cha method ma naam** 

    public function dashboard(){
        return view('dashboard');
    }

}
