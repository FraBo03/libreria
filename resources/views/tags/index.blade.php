@extends('layouts.tag') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    <div class="background"></div>

    <div class="content">

        <a href="{{ route('tags.create') }}" class="btn-custom">Add New Tag</a>

        <h2>Lista Tag</h2>

        <ol>
            @foreach ($tags as $tag)
            <li style="margin-top: 3px">
                {{ $tag->name}}
                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="display: inline-block;">Delete</button>
                </form>
                <a href="{{ route('tags.edit', $tag->id) }}">Edit</a>
            </li>
            @endforeach
        </ol>
    </div>
@endsection