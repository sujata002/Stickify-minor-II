<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // this method will show admin login page/screen

    public function index(){
        return view('admin.login');
    }
}
