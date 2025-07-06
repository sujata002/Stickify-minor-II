<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // this method will show dashboard to the user if email and password is correct and matches with database. user is redirected to dashboard after successful login
  // ** tyo tutorial ma chai dashboard lai index bhanera deko cha method ma naam** 

    public function dashboard(){
        return view('dashboard');
    }

}
