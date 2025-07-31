<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesViewController extends Controller
{
    public function index()
    {
       $notes = Note::where('user_id', Auth::id())->get();

        return view('note.index', compact('notes'));
    }

    public function create()
    {
        return view('note.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note_text' => 'required|string',
        ]);

        Note::create([
            'title' => $validated['title'],
            'note_text' => $validated['note_text'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('mynotes')->with('success', 'Note created successfully.');
    }

    public function edit($id)
    {
        $note = Note::where('user_id', Auth::id())->findOrFail($id);
        return view('note.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note_text' => 'required|string',
        ]);

        $note = Note::where('user_id', Auth::id())->findOrFail($id);
        $note->update($validated);

        return redirect()->route('mynotes')->with('success', 'Note updated successfully.');
    }

    public function delete($id)
    {
        $note = Note::where('user_id', Auth::id())->findOrFail($id);
        $note->delete();

        return redirect()->route('mynotes')->with('success', 'Note deleted successfully.');
    }

    public function trash()
    {
        $notes = Note::onlyTrashed()
                    ->where('user_id', Auth::id())
                    ->get();
        return view('note.trash', compact('notes'));
    }

    public function restore($id)
    {
        $note = Note::onlyTrashed()->findOrFail($id);
        $note->restore();
        return redirect()->route('mynotes.trash')->with('success', 'Note restored successfully.');
    }

    public function destroy($id)
    {
        $note = Note::onlyTrashed()->findOrFail($id);
        $note->forceDelete();
        return redirect()->route('mynotes.trash')->with('success', 'Note permanently deleted.');
    }

}