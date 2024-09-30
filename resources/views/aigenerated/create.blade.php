<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea un nuovo libro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        .form-group input[type="checkbox"] {
            width: auto;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Crea un nuovo libro</h1>

        <!-- Messaggi di errore -->
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form di creazione -->
        <form action="{{ route('aigenerated.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="author">Autore</label>
                <input type="text" name="author" id="author" value="{{ old('author') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="cover_image">Immagine di copertina</label>
                <input type="file" name="cover_image" id="cover_image" accept="image/*">
            </div>

            <div class="form-group">
                <label for="availability">
                    <input type="checkbox" name="availability" id="availability" {{ old('availability') ? 'checked' : '' }}>
                    Disponibilità
                </label>
            </div>

            <div class="form-group">
                <label for="tags">Tag</label>
                <select name="tags[]" id="tags" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit">Crea Libro</button>
            </div>
        </form>
    </div>

</body>
</html>
