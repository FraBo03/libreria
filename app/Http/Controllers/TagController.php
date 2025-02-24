<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all(); 

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Tag::create(['name' => $request->name]);
    
        return redirect()->route('tags.index')->with('success', 'Tag creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::find($id);
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $tag->update(['name' => $request->name]);
    
        return redirect()->route('tags.index')->with('success', 'Tag aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $tag = Tag::find($id);
        $tag->delete();
    
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
