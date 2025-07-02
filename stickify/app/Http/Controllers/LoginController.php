<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //this method will show login page for users
    public function index(){            // or keep login instead of index pachi herera milcha bhani
        return view('login');          // uta maile make: view login garera login.blade.php banako thiye. tyo call gareko

    }

    // aba login page lai authenticate garnu parcha. so for authentication we r making this new function
    
}
