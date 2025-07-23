<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtensionToken;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {
        $user = $request->user(); // Get authenticated user

        // Check if user exists (optional if auth middleware applied)
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if the user already has a token
        $existingToken = ExtensionToken::where('user_id', $user->id)->first();

        if (!$existingToken) {
            // Generate a unique 8-digit numeric token
            $token = $this->generateNumericToken(8);

            // Save the new token
            ExtensionToken::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => null,
                'is_used' => false,
            ]);
        } else {
            $token = $existingToken->token;
        }

        // Return token as JSON
        return response()->json(['token' => $token]);
    }

    private function generateNumericToken($length = 8)
    {
        do {
            $token = str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
        } while (ExtensionToken::where('token', $token)->exists());

        return $token;
    }
}
