<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesController extends Controller
{
    public function store(Request $request)
    {
        // incoming data lai validate garcha 
        $request->validate([
            'note_text' => 'required|string',
            'url' => 'nullable|string',
        ]);

        // notes() ley chai relationship model call garcha which is defined in user model 
        //create ley chai naya note create garcha automatically user_id ko through database ma connect vayera 
        $note = $request->user()->notes()->create([
            'note_text' => $request->note_text,
            'url' => $request->url,
        ]);

        // 201 status code vaneko "created" ho 
        return response()->json($note, 201);
    }
}
