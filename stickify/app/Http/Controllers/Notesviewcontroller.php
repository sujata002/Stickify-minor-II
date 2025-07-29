<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesViewController extends Controller
{
    // Show the "My Notes" Blade view (JS will load the notes)
    public function index()
    {
        // You are not passing $notes to the Blade view
        return view('mynotes');
    }

    // Fetch all notes for the authenticated user (AJAX)
    public function fetchNotes(Request $request)
    {
        $notes = $request->user()->notes()->latest()->get();
        return response()->json($notes);
    }

    // Store a new note
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note_text' => 'required|string',
        ]);

        $note = $request->user()->notes()->create([
            'note_title' => $validated['title'],
            'note_text' => $validated['note_text'],
        ]);

        return response()->json($note, 201);
    }

    // Get a single note
    public function show(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        return response()->json($note);
    }

    // Update an existing note
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note_text' => 'required|string',
        ]);

        $note = $request->user()->notes()->findOrFail($id);
        $note->update([
            'note_title' => $validated['title'],
            'note_text' => $validated['note_text'],
        ]);

        return response()->json(['message' => 'Note updated']);
    }

    // Delete a note
    public function destroy(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted']);
    }
}
