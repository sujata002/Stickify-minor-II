<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\ExtensionTokens;
use Illuminate\Support\Facades\Auth;


class NotesController extends Controller
{

    //Display the dashboard view.
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'user') {           
            return redirect()->route('user.dashboard');
        }
        return view('dashboard');
    }

    //Save a note submitted from the extension with url jata bat note leko with user id

    public function saveNote(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'note_text' => 'required|string',
            'url' => 'required|url',
        ]);
        $token = $request->bearerToken();

        $extensionToken = ExtensionTokens::where('token', $token)->first();

        if (!$extensionToken || $extensionToken->is_used || $extensionToken->expires_at->isPast()) {
            return response()->json(['valid' => false, 'message' => 'Invalid or expired token'], 401);
        }

        $note = new Note();
        $note->user_id = $extensionToken->user_id;  //  uses user_id from token
        $note->note_text = $request->input('note_text');  //  matches the  JS
        $note->title = $request->input('title'); // ADD THIS
        $note->url = $request->input('url');
        $note->save();


        return response()->json([
            'valid' => true,
            'message' => 'Note saved successfully'
        ], 200);
        return redirect()->route('mynotes');
    }
}
