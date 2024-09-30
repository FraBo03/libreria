@extends('layouts.reader') <!-- O il layout che stai usando -->

@section('content')
    @include('header') <!-- Includi il file header.blade.php -->

    <div class="background"></div>

    <div class="content">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <h2>Your Loans</h2>
        @if($loans->isEmpty())
            <p>You have not borrowed any books yet.</p>

        @else
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book Title</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Returned Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loan->id }}</td>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->borrowed_at }}</td>
                            <td>{{ $loan->due_at ?? 'N/A' }}</td>
                            <td>{{ $loan->returned_at ?? 'Not returned yet' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
