@extends('layouts.book') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    <div class="background"></div>

    <div class="content">
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ $book->title }}" required>
            </div>

            <div>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="{{ $book->author }}" required>
            </div>

            <div>
                <label for="tags">Tags:</label><br>
                <div style="max-height: 100px; overflow-y: auto;">
                    @foreach($tags as $tag)
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                        {{ $book->tags->contains($tag->id) ? 'checked' : '' }}>
                        {{ $tag->name }}<br>
                    @endforeach
                </div>
            </div>
    
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description">{{ $book->description }}</textarea>
            </div>
    
            <div>
                <label for="cover_image">Current Cover Image:</label><br>
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" style="max-width: 150px;">
                @else
                    <p>No cover image available.</p>
                @endif
            </div>
    
            <div>
                <label for="cover_image">Replace Cover Image:</label>
                <input type="file" id="cover_image" name="cover_image">
            </div>
    
            <div>
                <label for="availability">Availability:</label>
                <input type="checkbox" id="availability" name="availability" {{ $book->availability ? 'checked' : '' }}>
            </div>

            <button type="submit">Update Book</button>
        </form>
    </div>
@endsection