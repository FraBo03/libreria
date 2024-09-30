@extends('layouts.book') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    <div class="background"></div>

    <div class="content">
        <form action="{{ route('tags.update', $tag->id) }}" method="POST" >
            @csrf
            @method('PUT')
    
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $tag->name }}" required>
            </div>

            <button type="submit" style="margin-top: 3px">Update Tag</button>
        </form>
    </div>
@endsection
    