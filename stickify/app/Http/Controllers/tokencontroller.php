<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtensionToken;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        // Check if the user already has a token
        $existingToken = ExtensionToken::where('user_id', $user->id)->first();

        if (!$existingToken) {
            // Generate a unique 8-digit token
            $token = $this->generateNumericToken(8);

            // Save the new token to the database
            ExtensionToken::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => null, // Optional: Set an expiry date if needed
                'is_used' => false,   // Token initially unused
            ]);
        } else {
            // Use the existing token
            $token = $existingToken->token;
        }

        // Return the token as a JSON response
        return response()->json(['token' => $token]);
    }

    private function generateNumericToken($length = 8)
    {
        do {
            // Generate a random numeric token of the specified length
            $token = str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
        } while (ExtensionToken::where('token', $token)->exists()); // Ensure it's unique

        return $token;
    }
}
