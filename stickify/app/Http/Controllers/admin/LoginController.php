<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    // this method will show admin login page/screen

    public function index(){

        // to redirect admin in dashboard if they try to access admin/login while already being in dashboard
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // this method will authenticate admin user
     public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()){

            // checks email and password in DB if admin exists or not. If exists and is valid, admin is authenticated, 
            // and logs the admin in by creating a session and then red..   irected to dashboard. 

            if (Auth::attempt(['email' => $request->email,'password' => $request->password])){
               
                $user = Auth::guard('admin')->user();

                // dd($user->role);   // debug to see which role is logged in
                    
                if (Auth::user()->role === 'admin'){                  
                    // redirect admin to admin dashboard
                    return redirect()->route('admin.dashboard');
                    
                } else {

                    Auth::guard('admin')->logout();    // to manually log out user if their role is not admin by clearing out their session
                    return redirect()->route('admin.login')->with('error', 'You are not authorized to access this page');
                }

            } else {
                return redirect()->route('admin.login')
                ->withInput()
                ->with('error','Either email or password is incorrect.');     // if error in password occurs, it redirects to admin login page displaying the message
            }

        } else {    
            // if validation error occurs
            return redirect()->route('admin.login')
            ->withInput()                          // withInput kina deko bhani email ko value clear na hos if error aayera reload garda bhanera
            ->withErrors($validator);              // yo chai form ma error lai pani display garnu parcha tesaile lekheko
        }
    }

    // this method will logout admin user
    public function logout(){
        Auth::guard('admin')->logout();
        Session::flush();  
        return redirect()->route('admin.login');
    }

}




 
/*     How if condition inside index function works

auth()->check() verifies if any user is logged in

auth()->user()->role === 'admin' ensures only admins get redirected to admin dashboard

So, if a logged-in admin tries to access /admin/login, they get redirected to their dashboard */


 

