<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    const IMG_URL = "/storage/images/";

    public function index(Request $request){

        $query = Book::query();

        if ($request->has('title') && $request->title != '') {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('author') && $request->author != '') {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        // Filtro per tag
        if ($tagId = $request->input('tag_id')) {
            $query->whereHas('tags', function($query) use ($tagId) {
                $query->where('tags.id', $tagId);
            });
        }

        $books = $query->get();

        $tags = Tag::all();
        return view('books.index', compact('books', 'tags'));
        //return view('aigenerated.books', compact('books', 'tags'));
    }

    public function create(){
        $tags = Tag::all(); // Recupera tutti i tag
        return view('books.create', compact('tags'));
        //return view('aigenerated.create', compact('tags'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $availability = $request->has('availability');

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $coverImagePath = $file->store('cover_images', 'public');
        }
    
        $book = Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'cover_image' => $coverImagePath,
            'availability' => $availability,
        ]);

        // Associa i tag al libro
        $book->tags()->attach($request->input('tags', []));
    
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show($id){
        $book = Book::find($id);
        return view('books.show', compact('book'));
    }

    public function destroy($id){
        $book = Book::find($id);
        $book->delete();
    
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function edit($id){
        $book = Book::find($id);
        $tags = Tag::all(); // Recupera tutti i tag
        return view('books.edit', compact('book', 'tags'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    
        $book = Book::findOrFail($id);

        // Se viene caricata una nuova immagine, elimina quella vecchia e salva la nuova
        if ($request->hasFile('cover_image')) {
            // Elimina l'immagine vecchia se esiste
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
    
            // Salva la nuova immagine
            $book->cover_image = $request->file('cover_image')->store('cover_images', 'public');
        }

        $book->update([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'availability' => $request->has('availability'),
        ]);

        $book->tags()->sync($request->input('tags', []));
    
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }
}