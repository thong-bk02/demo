<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AKB Software-</title>
</head>

<body class="antialiased">
    <div
        class="">
        @if (Route::has('login'))
            <div class="">
                @auth
                    @if (Auth::user()->admin == 1)
                    <a href="{{ url('/home') }}" class="">Home</a>
                    @else
                    <a href="{{ url('/users') }}" class="">Home</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="">Log in</a>
                @endauth
            </div>
        @endif
    </div>
</body>

</html>
