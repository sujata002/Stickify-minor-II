<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\User;
use App\Models\Payment;

class StripeController extends Controller
{
    public function session(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Stickify Premium Upgrade',
                    ],
                    'unit_amount' => 2.50 * 100, // 250 cents = $2.50
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'). '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'). '?session_id={CHECKOUT_SESSION_ID}',
        ]);
        return redirect($session->url);
    }


    public function success(Request $request){

        Stripe::setApiKey(config('services.stripe.secret'));

    $session_id = $request->get('session_id');
    if (!$session_id) {
        return 'Session ID missing!';
    }

    $session = Session::retrieve($session_id);

    // getting customer email from Stripe session
    $customer_email = $session->customer_details->email;

    // finding logged in user by email
    $user = User::where('email', $customer_email)->first();

        if ($user) {

            // saving payment record in db
            Payment::create([
                'user_id' => $user->id,
                'stripe_session_id' => $session_id,
                'amount' => $session->amount_total,
                'currency' => $session->currency,
                'status' => $session->payment_status,
                'payment_method' => 'card',
            ]);
            $user->is_premium = true;
            $user->save();  
        }

        // Redirect where you want
        return redirect()->route('user.dashboard')->with('success', 'You are now a Premium User!');

    }


    public function cancel(Request $request){
        return redirect()->route('user.dashboard')->with('error', 'Payment was cancelled. You can try again anytime.');
    }

}