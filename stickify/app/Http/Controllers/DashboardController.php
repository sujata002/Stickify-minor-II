<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // this method will show dashboard to the user if email and password is correct and matches with database. user is redirected to dashboard after successful login
  // ** tyo tutorial ma chai dashboard lai index bhanera deko cha method ma naam** 

    public function dashboard(){
        return view('dashboard');
    }

    // for showing payment record
    public function billingHistory(){
      $user = Auth::user();
      $payments = Payment::where('user_id', $user->id)->latest()->paginate(10);
      return view('billinghistory', compact('payments'));
  }

}