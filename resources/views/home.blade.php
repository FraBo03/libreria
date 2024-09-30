<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Libreria</title>

        <style>
            .hidden { display: none;}
            .top-right { position: absolute; top: 10px; right: 10px;}
            .middle-right { position: absolute; top: 140px; right: 10px;}
        </style>
    </head>
    <body>
        <center>
            <a href="{{ route('home') }}"><h1>Libreria Bonavita</h1></a>
            <a href="{{ route('books.index') }}">Books</a>
            <a href="{{ route('loans.index') }}">Loans</a>
        </center>

        <div class="top-right">
            @guest
            <a href="{{ route('login') }}">
                <button>Login</button></a>
            @else
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
                </form>
            @endguest
        </div>
    </body>
</html>