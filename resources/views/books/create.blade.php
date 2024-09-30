@extends('layouts.book') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    <div class="background"></div>

    <div class="content">
        Inserisci i Dati
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>
    
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            </div>
    
            <div>
                <label for="cover_image">Cover Image:</label>
                <input type="file" id="cover_image" name="cover_image">
            </div>

            <div>
                <label for="tags">Tags:</label>

                <div style="max-height: 100px; overflow-y: auto;">
                    @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                        <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label><br>
                    @endforeach
                </div>
            </div>
    
            <div>
                <label for="availability">Availability:</label>
                <input type="checkbox" id="availability" name="availability" checked>
            </div>
    
            <button type="submit">Add Book</button>
        </form>
    </div>
@endsection