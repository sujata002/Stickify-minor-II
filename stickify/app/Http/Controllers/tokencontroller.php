<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExtensionToken;
use App\Models\ExtensionTokens;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class tokenController extends Controller
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

        $existingToken = ExtensionTokens::where('user_id', $user->id)->first();

        if (!$existingToken) {
            $token = $this->generateNumericToken(8);

            ExtensionTokens::create([
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
        } while (ExtensionTokens::where('token', $token)->exists());

        return $token;
    }
    // verify the token submitted from the extension popup check
    // if the token matches with the generated token or not
    public function verifyToken(Request $request)
{
    $request->validate([
        'token' => 'required|string|size:8',
    ]);

    $token = $request->input('token');

    $extensionToken = ExtensionTokens::where('token', $token)->first();

    if (!$extensionToken) {
        return response()->json(['valid' => false, 'message' => 'Invalid token'], 401);
    }

    if ($extensionToken->expires_at && $extensionToken->expires_at->isPast()) {
        return response()->json(['valid' => false, 'message' => 'Token has expired'], 401);
    }

    if ($extensionToken->is_used) {
        return response()->json(['valid' => false, 'message' => 'Token already used'], 401);
    }

    // Get associated user
    $user = $extensionToken->user;

    return response()->json([
        'valid' => true,
        'message' => 'Token verified successfully',
        'user_id' => $user->id,
        'user_email' => $user->email,
    ]);
}
}