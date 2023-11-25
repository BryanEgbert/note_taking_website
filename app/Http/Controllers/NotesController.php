<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Notes::where('user_id', Auth::id())->orderBy('created_at', 'desc')->cursorPaginate(15);
        // dd($notes);
        return view('notes', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $content = $request->input('content');
        $title = $request->input('title');

        if (empty($content) && empty($title)) {
            return redirect()->intended('/notes');
        }

        $titleDefault = (strlen($content) < 20) ? $content : (substr($content, 0, 17) . '...');
        // $title = $request->input('title', $titleDefault);
        if (empty($title)) {
            $title = $titleDefault;
        }

        $notes = Notes::create([
            'user_id' => Auth::id(),
            'title' => $title,
            'content' => $request->input('content'),
        ]);

        return redirect(url("notes/$notes->id"));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $notes)
    {
        return redirect()->intended('/notes');        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $notes)
    {
        $content = $request->input('editContent');
        $title = $request->input('editTitle');

        if (empty($content) && empty($title)) {
            return redirect()->intended('/notes');
        }

        $titleDefault = (strlen($content) < 20) ? $content : substr($content, 0, 17) . '...';
        $title = $request->input('title', $titleDefault);

        Notes::where('id', $notes)->update(['title' => $title, 'content' => $content]);

        return redirect(url("/notes?id=$notes"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $note)
    {
        $deletedId = Notes::destroy($note);

        return redirect()->intended('/notes');
    }
}
