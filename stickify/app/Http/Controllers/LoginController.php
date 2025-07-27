<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    //this method will show login page for users
    public function index(){          

        // to redirect users in dashboard if they try to access account/login while already being in dashboard
        if (Auth::check() && Auth::user()->role === 'user') {           
            return redirect()->route('user.dashboard');
        } 

        return view('login');          
    }

    // aba login page ma bhako user lai authenticate garnu parcha. so for authentication we r making this new method called authenticate. 
    //login form submission huda authenticate bhanni route ma jancha ra yo authenticate bhanni method run huncha

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()){

            // checks email and password in DB if user exists or not. If exists and is valid, user is authenticated, 
            // and logs the user in by creating a session and then redirected to dashboard. 

            if (Auth::attempt(['email' => $request->email,'password' => $request->password])){

                $user = Auth::user();

                if ($user->role === 'admin') {
                    // redirect admin to admin dashboard
                    // return redirect()->route('admin.dashboard');        // yo admin/dashboard garda chai account/login ma admin le login garda user dashboard nai dekhaucha with Hello, Admin
                    return redirect()->route('admin.login');                 // redirecting admin to admin/login page if they try to login from account/login page

                } else {
                    // redirect regular user to user dashboard
                    return redirect()->route('user.dashboard');
                }

            } else {
                return redirect()->route('login')
                ->withInput()
                ->with('error','Either email or password is incorrect.');     // if error in password occurs, it redirects to login page displaying the message
            }

        } else {
            return redirect()->route('login')
            ->withInput()                          // withInput kina deko bhani email ko value clear na hos if error aayera reload garda bhanera
            ->withErrors($validator);              // yo chai form ma error lai pani display garnu parcha tesaile lekheko
        }
    }

    // this method will show regsitration page 

    public function register(){    // injecting request

        // to redirect users in dashboard if they try to access account/register while already being in dashboard
        if (Auth::check() && Auth::user()->role === 'user') {
            return redirect()->route('user.dashboard');
        }
        return view('register');      

    }

    public function processRegister(Request $request){

        $validator = Validator::make($request->all(),[        // validating form    
            'email' => 'required|email|unique:users',       // yo users chai DB table ho user ko lagi. Email is required, must be in unique and in valid format, and not already in the users table.
            'user' => 'required|string|max:255',          // for user input field in sign up page
            'password' => 'required|confirmed',          // Password is required, must match password_confirmation field, and be at least 8 characters long.
            'password_confirmation' => 'required' 
        ]);

            if ($validator->passes()){         // checks if the form data is valid. if yes, user is created. if no, shows error in the else block
 
                // creating and saving the user
                $user = new \App\Models\User();                   // creates a new instance of User model.

                $user->name = $request->user;                    // gets the 'user' field from the form and stores it in the `name` column of the database
                
                $user->email = $request->email;                  // takes the email from the form and assigns it to the user
                
                $user->password = Hash::make($request->password);       // hashes (encrypts) the password before saving to db
                
                $user->role = 'user';                           // every time someone registers, assigning them the role 'user' no matter what since there is no other role in this app

                $user->save();                                      // saves the new user to the users table in the database.

            // redirecting to login page with success message

                return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
 
            } else {
                return redirect()->route('register')
                ->withInput()                          // withInput kina deko bhani email ko value clear na hos if error aayera reload garda bhanera
                ->withErrors($validator);              // yo chai form ma error lai pani display garnu parcha tesaile lekheko
            }
    }

    // to log out from user dashboard

    public function logout(){
        Auth::logout();
        Session::flush();  
        return redirect()->route('login');
    }

}






/*     About auth::attempt

it finds the user by email

then it automatically uses Hash::check() internally to compare & verify the plain password with the hashed one in the DB

if the credentials match, Laravel logs in the user and sets the session.  */



/*   How if condition inside index and register method works

if the user is already logged in and has the role user, they will be immediately redirected to /account/dashboard 
if they try to access /account/login or /account/register

if not logged in, they’ll see the login or registration page as usual

this works even though we're not using the guest middleware or Laravel's default guards */