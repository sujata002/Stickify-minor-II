<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    //this method will show login page for users
    public function index(){            // or keep login instead of index pachi herera milcha bhani
        return view('login');          // uta maile make: view login garera login.blade.php banako thiye. tyo call gareko

    }

    // aba login page ma bhako user lai authenticate garnu parcha. so for authentication we r making this new method called authenticate. 
    //login form submission huda authenticate bhanni route ma jancha ra yo authenticate bhanni method run huncha

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()){

            if (Auth::attempt(['email' => $request->email,'password' => $request->password])){

            } else {
                return redirect()->route('login')->with('Either email or password is incorrect.');     // if error in password occurs, it redirects to login page displaying the message
            }

        } else {
            return redirect()->route('login')
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
            'email' => 'required|email|unique:users',       // yo users chai DB table ho user ko lagi. Email is required, must be in valid format, and not already in the users table.
            'user' => 'required|string|max:255',          // for user input field in sign up page
            'password' => 'required|confirmed'           // Password is required, must match password_confirmation field, and be at least 8 characters long.
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

}






// about auth::attempt

// it finds the user by email

// then it automatically uses Hash::check() internally to compare & verify the plain password with the hashed one in the DB

// if the credentials match, Laravel logs in the user and sets the session. 