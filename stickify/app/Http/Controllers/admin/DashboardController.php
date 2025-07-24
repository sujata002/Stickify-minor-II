<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    // this method will show dashboard to admin if email and password is correct and matches with database. admin is redirected to admin dashboard after successful login
  // ** tyo tutorial ma chai dashboard lai index bhanera deko cha method ma naam** 

  public function dashboard(){
    return view('admin.dashboard');
  }

  // show users list page
  public function users(){
    $users = User::all();  // Fetch all users from DB
    return view('admin.users', compact('users'));
  }

  // for deleting a user by ID
  public function deleteUser($id) {
    $user = User::findOrFail($id);

    // optional: Prevent deleting yourself or other admins if needed

    $user->delete();

    return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
  }
  
  public function promoteUser($id){
    $user = User::findOrFail($id);

    // is_premium coloum in user table is added later on
    $user->is_premium = true;
    $user->save();

    return redirect()->route('admin.users')->with('success', 'User promoted to premium successfully.');
  }

  // for editing user 
  public function editUser($id){
    $user = User::findOrFail($id);
    return view('admin.edit_user', compact('user'));
  }

  // this method handles form submission when we update a user’s profile 
  public function updateUser(Request $request, $id){
    $user = User::findOrFail($id);                       // finds the user in the database by their ID ($id)

    $request->validate([                    // validates the input to make sure name,email, and role is required 
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'role' => 'required|in:user,admin',
    ]);

    // updates the user’s data with the new values
    $user->name = $request->name;                 
    $user->email = $request->email;
    $user->role = $request->role;
    $user->save();                    // saves user back to the database

    return redirect()->route('admin.users')->with('success', 'User profile updated successfully.');     // redirects back to the users list page with a success message like “User profile updated successfully.”
  }

  // for choosing role for users from dropdown and saving it in db from users list page
  public function updateUserRole(Request $request, $id){
    $user = User::findOrFail($id);

    $request->validate([
      'role' => 'required|in:user,admin',
    ]);

    $user->role = $request->role;
    $user->save();

    return redirect()->route('admin.users')->with('success', 'User role updated successfully.');
  }
}
