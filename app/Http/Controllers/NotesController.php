<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;
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
        $notes = Notes::where('user_id', Auth::id())->get();
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
        $titleDefault = (strlen($content) < 50) ? $content : substr($content, 0, 57) . '...';
        $title = $request->input('title', $titleDefault);

        Notes::create([
            'user_id' => Auth::id(),
            'title' => $title,
            'content' => $request->input('content'),
        ]);

        return redirect()->intended('/notes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes)
    {
        //
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
    public function update(UpdateNotesRequest $request, Notes $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notes $notes)
    {
        //
    }
}
