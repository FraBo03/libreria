<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>New Book</title>

    </head>
    <body>
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
    
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
    
            <div>
                <label for="book_id">Book:</label>
                <select name="book_id" id="book_id" required>
                    <option value="" disabled selected>Select a book</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="user_id">Borrower:</label>
                <select name="user_id" id="user_id" required>
                    <option value="" disabled selected>Select a borrower</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="borrowed_at">Borrowed Date:</label>
                <input type="date" name="borrowed_at" id="borrowed_at" value="{{ old('borrowed_at') }}" required>
            </div>

            <div>
                <label for="due_at">Due Date:</label>
                <input type="date" name="due_at" id="due_at" value="{{ old('due_at') }}">
            </div>

            <div>
                <label for="returned_at">Returned Date:</label>
                <input type="date" name="returned_at" id="returned_at" value="{{ old('returned_at') }}">
            </div>

            
            <button type="submit">Create Loan</button>
            
        </form>
    </body>
</html>