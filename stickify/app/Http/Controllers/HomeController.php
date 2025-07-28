<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }
}

//HomeController added by samira 
//idk i forgot why i added this file 