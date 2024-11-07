<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/book.css') }}">
    <link rel="stylesheet" href="{{ asset('css/green_button.css') }}">
    
</head>
<body>
    <header>

    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p style="color: white; margin-left: 20px;">&copy; {{ date('Y') }} Libreria Bonavita</p>
    </footer>
</body>
</html>
