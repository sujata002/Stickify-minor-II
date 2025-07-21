<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // this method will show dashboard to admin if email and password is correct and matches with database. admin is redirected to admin dashboard after successful login
  // ** tyo tutorial ma chai dashboard lai index bhanera deko cha method ma naam** 

  public function dashboard(){
    return view('admin.dashboard');
  }

//   public function dashboard(){
//     dd('ADMIN DASHBOARD CONTROLLER HIT');
// }


}
