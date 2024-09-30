@extends('layouts.book') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    <div class="background"></div>

    <div class="content">
        <form action="{{ route('tags.store') }}" method="POST" >
            @csrf
    
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <button type="submit" style="margin-top: 3px">Create Tag</button>
        </form>
    </div>
@endsection
