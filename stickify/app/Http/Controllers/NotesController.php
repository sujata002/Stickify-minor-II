<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesController extends Controller
{
    // List all notes for the authenticated user
    public function index(Request $request)
    {
        $notes = $request->user()->notes()->get();
        return response()->json($notes);
    }

    // Create a new note
    public function store(Request $request)
    {
        $request->validate([
            'note_text' => 'required|string',
            'url' => 'nullable|string',
        ]);

        $note = $request->user()->notes()->create([
            'note_text' => $request->note_text,
            'url' => $request->url,
        ]);

        return response()->json($note, 201);
    }

    // Show a single note by ID
    public function show(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        return response()->json($note);
    }

    // Update a note by ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'note_text' => 'required|string',
            'url' => 'nullable|string',
        ]);

        $note = $request->user()->notes()->findOrFail($id);
        $note->update([
            'note_text' => $request->note_text,
            'url' => $request->url,
        ]);

        return response()->json($note);
    }

    // Delete a note by ID
    public function destroy(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
    }
}
