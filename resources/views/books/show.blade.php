@extends('layouts.book') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    <div class="background"></div>

    <div class="content">
        <h1>{{ $book->title }}</h1>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        
        <strong>Tags:</strong>
        @if ($book->tags->isNotEmpty())
            @foreach ($book->tags as $tag)
                <span class="tag">{{ $tag->name }}</span>
            @endforeach
        @else
            No tags available.
        @endif

        <p><strong>Description:</strong> {{ $book->description }}</p>

        @if ($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" style="max-width: 300px; max-height: 300px">
        @else
            <p>No cover image available.</p>
        @endif

        <p><strong>Availability:</strong> {{ $book->availability ? 'Available' : 'Not Available' }}</p>
    </div>
@endsection