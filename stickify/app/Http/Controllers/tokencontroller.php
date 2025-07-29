<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExtensionToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {
        // $user = User::first();

        $user = Auth::user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'No users exist. Create one first.'], 404);
            }
            return redirect()->back()->with('error', 'Please log in first to generate a token.');
        }

        $existingToken = ExtensionToken::where('user_id', $user->id)->first();

        if (!$existingToken) {
            $token = $this->generateNumericToken(8);

            ExtensionToken::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => null,
                'is_used' => false,
            ]);
        } else {
            $token = $existingToken->token;
        }

        if ($request->expectsJson()) {
            return response()->json(['token' => $token]);
        }

        return redirect()->back()->with('token', $token);
    }

    private function generateNumericToken($length = 8)
    {
        do {
            $token = str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
        } while (ExtensionToken::where('token', $token)->exists());

        return $token;
    }
}
