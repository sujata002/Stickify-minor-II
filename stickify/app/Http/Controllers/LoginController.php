<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //this method will show login page for users
    public function index(){            // or keep login instead of index pachi herera milcha bhani
        return view('login');          // uta maile make: view login garera login.blade.php banako thiye. tyo call gareko

    }

    // aba login page ma bhako user lai authenticate garnu parcha. so for authentication we r making this new method called authenticate. 
    //login form submission huda account.authenticate bhanni route ma jancha ra yo authenticate bhanni method run huncha

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()){

            if (Auth::attempt(['email' => $request->email,'password' => $request->password])){

            } else {
                return redirect()->route('account.login')->with('Either email or password is incorrect.');     // if error in password occurs, it redirects to login page displaying the message
            }

        } else {
            return redirect()->route('account.login')
            ->withInput()                          // withInput kina deko bhani email ko value clear na hos if error aayera reload garda bhanera
            ->withErrors($validator);              // yo chai form ma error lai pani display garnu parcha tesaile lekheko
        }
    }

    // this method will show regsitration page 

    public function register(){    // injecting request

        return view('register');      

    }

    public function processRegister(Request $request){

        $validator = Validator::make($request->all(),[        // validating form
            'email' => 'required|email|unique:users',             // yo users chai DB table ho user ko lagi. esma confusion cha k garni ho bhanera
            'password' => 'required|confirmed'
        ]);

            if ($validator->passes()){

                if (Auth::attempt(['email' => $request->email,'password' => $request->password])){

                
            } else {
                return redirect()->route('account.register')
                ->withInput()                          // withInput kina deko bhani email ko value clear na hos if error aayera reload garda bhanera
                ->withErrors($validator);              // yo chai form ma error lai pani display garnu parcha tesaile lekheko
            }
        
        }


    }
}