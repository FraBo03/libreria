<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista dei Libri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .book-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .book {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 250px;
        }
        .book img {
            max-width: 100%;
            height: auto;
        }
        .book h3 {
            font-size: 18px;
        }
        .book p {
            font-size: 14px;
        }
        .availability {
            font-weight: bold;
        }
        .available {
            color: green;
        }
        .unavailable {
            color: red;
        }
    </style>
</head>
<body>

    <h1>Lista dei Libri</h1>

    <!-- Form di Ricerca -->
    <form action="{{ route('books.index') }}" method="GET" class="search-form">
        <div>
            <label for="title">Titolo:</label>
            <input type="text" name="title" id="title" value="{{ request('title') }}">
        </div>
        <div>
            <label for="author">Autore:</label>
            <input type="text" name="author" id="author" value="{{ request('author') }}">
        </div>
        <div>
            <label for="tag_id">Tag:</label>
            <select name="tag_id" id="tag_id">
                <option value="">Seleziona un tag</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Cerca</button>
    </form>

    <div class="book-container">
        @forelse($books as $book)
            <div class="book">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image">
                <h3>{{ $book->title }}</h3>
                <p><strong>Autore:</strong> {{ $book->author }}</p>
                <p>{{ $book->description ?? 'Descrizione non disponibile' }}</p>
                <p class="availability {{ $book->availability ? 'available' : 'unavailable' }}">
                    {{ $book->availability ? 'Disponibile' : 'Non disponibile' }}
                </p>
            </div>
        @empty
            <p>Nessun libro trovato.</p>
        @endforelse
    </div>

</body>
</html>
