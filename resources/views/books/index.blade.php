@extends('layouts.book') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    <div class="background"></div>

    <div class="content">
        @if ($errors->any())
            <div class="middle-right">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @auth @if (auth()->user()->roles()->where('role_id', 2)->exists())
            
            <a href="{{ route('books.create') }}" class="btn-custom">Add New Book</a>
            <a href="{{ route('tags.index') }}" class="btn-custom">Tags</a>
            
            <h2>Lista Libri</h2> 
            
            <div class="filter-container">
                <form action="{{ route('books.index') }}" method="GET">
                    <input type="text" name="title" class="filter-input" placeholder="Cerca per titolo" value="{{ request('title') }}">
                    <input type="text" name="author" class="filter-input" placeholder="Cerca per autore" value="{{ request('author') }}">
                    <label for="tag_id">Cerca per Tag:</label>
                    <select name="tag_id" id="tag_id">
                        <option value="">Tutti i Tag</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <button type="submit">Filtra</button>
                </form>
            </div>

            <div class="book-container">
                @foreach ($books as $book)
                <div class="book-item">
                    <a href="{{ route('books.show', $book->id) }}" style="color: white;"><h3>{{ $book->title }}</h3></a>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image">
                    <div class="actions">
                        <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        
        @else
            <h2>Lista Libri</h2>

            <div class="filter-container">
                <form action="{{ route('books.index') }}" method="GET">
                    <input type="text" name="title" class="filter-input" placeholder="Cerca per titolo" value="{{ request('title') }}">
                    <input type="text" name="author" class="filter-input" placeholder="Cerca per autore" value="{{ request('author') }}">
                    <button type="submit">Filtra</button>
                </form>
            </div>

            <div class="book-container">
                @foreach ($books as $book)
                <div class="book-item">
                    <a href="{{ route('books.show', $book->id) }}" style="color: white;"><h3>{{ $book->title }}</h3></a>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image">
                </div>
                @endforeach
            </div>
        @endif 

        @else 
            <h2>Lista Libri</h2>

            <div class="filter-container">
                <form action="{{ route('books.index') }}" method="GET">
                    <input type="text" name="title" class="filter-input" placeholder="Cerca per titolo" value="{{ request('title') }}">
                    <input type="text" name="author" class="filter-input" placeholder="Cerca per autore" value="{{ request('author') }}">
                    <input type="text" name="author" class="filter-input" placeholder="Cerca per autore" value="{{ request('author') }}">
                    <button type="submit">Filtra</button>
                </form>
            </div>

            <div class="book-container">
                @foreach ($books as $book)
                <div class="book-item">
                    <a href="{{ route('books.show', $book->id) }}" style="color: white;"><h3>{{ $book->title }}</h3></a>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image">
                </div>
                @endforeach
            </div>
        @endauth
    </div>
@endsection
