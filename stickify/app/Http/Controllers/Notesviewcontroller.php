<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesViewController extends Controller
{
    public function index(Request $request)
    {
        // Fetch notes for the logged-in user
        $notes = $request->user()->notes()->get();

        // Pass notes to the 'mynotes' Blade view
        return view('mynotes', compact('notes'));
    }
}
