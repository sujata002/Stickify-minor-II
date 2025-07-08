<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesController extends Controller
{
    // harek user ko overall notes haru lai list garne 
    public function index(Request $request)
    {
        // gets all notes that belongs to the logged in user and sends back to JSON response 
        $notes = $request->user()->notes()->get();
        return response()->json($notes);
    }

    // naya note creation part 
    public function store(Request $request)
    {
        $request->validate([
            'note_text' => 'required|string',
            'url' => 'nullable|string',
        ]);
        // creates a new note for currently logged in user using note text and url 
        $note = $request->user()->notes()->create([
            'note_text' => $request->note_text,
            'url' => $request->url,
        ]);

        return response()->json($note, 201);
    }

    //  note ko detail dekhaune through id 
    public function show(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        //sends the note back to user ko browswer 
        return response()->json($note);
    }

    // id ko through note update garne 
    public function update(Request $request, $id)
    {
        $request->validate([
            'note_text' => 'required|string',
            'url' => 'nullable|string',
        ]);
        // gets currently logged in vako user and accesses user ko related notes through models relationship
        //if note exists note is given back or error throw garcha 404 not found 
        $note = $request->user()->notes()->findOrFail($id);
        // note update huncha if any changes made 
        $note->update([
            'note_text' => $request->note_text,
            'url' => $request->url,
        ]);

        return response()->json($note);
    }

    // id ko through note delete garne 
    public function destroy(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
        // JSON(Java Script Object Notation) is a lightweight text or simple text jun chai
        // server dekhi client ko broswer ma jancha so client can easily use that data 
        // in this case user lai chai note succesfully delete bhayo vanera message jancha,communicate garne medium ho user sanga 
        
    }
}
