<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Libreria Corelab</title>

        <style>
            .hidden { display: none;}
            .top-right { position: absolute; top: 10px; right: 10px;}
            .middle-right { position: absolute; top: 140px; right: 10px;}
        </style>
    </head>
    <body>
        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div>
                <label for="book_id">Book:</label>
                <select name="book_id" id="book_id" required>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ $loan->book_id == $book->id ? 'selected' : '' }}>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label for="user_id">User:</label>
                <select name="user_id" id="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $loan->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label for="borrowed_at">Borrowed Date:</label>
                <input type="date" name="borrowed_at" id="borrowed_at" value="{{ old('borrowed_at', $loan->borrowed_at) }}" required>
            </div>
    
            <div>
                <label for="due_at">Due Date:</label>
                <input type="date" name="due_at" id="due_at" value="{{ old('due_at', $loan->due_at) }}">
            </div>
    
            <div>
                <label for="returned_at">Returned Date:</label>
                <input type="date" name="returned_at" id="returned_at" value="{{ old('returned_at', $loan->returned_at) }}">
            </div>
    
            <div>
                <button type="submit">Update Loan</button>
            </div>
        </form>
    
        <a href="{{ route('loans.index') }}" style="color: black;">Back to Loans</a>
    </body>
</html>