<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Create a note for the authenticated user
        $note = $request->user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($note, 201);
    }
}
