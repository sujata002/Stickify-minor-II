<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // this method will show dashboard to the user if email and password is correct and matches with database. user is redirected to dashboard after successful login

    public function dashboard(){
      return view('dashboard');
    }

    // for showing payment record
    public function billingHistory(){
      $user = auth()->user();
      $payments = Payment::where('user_id', $user->id)->latest()->paginate(10);
      return view('billinghistory', compact('payments'));
    }

}
