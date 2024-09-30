<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

    </head>
    <body>
        <h1>Login</h1>
    
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input style="margin-bottom: 3px" type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input style="margin-bottom: 3px" type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </body>
</html>