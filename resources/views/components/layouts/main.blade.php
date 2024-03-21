<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Encrypted logger</title>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="antialiased">
        <div class="relative justify-between min-h-screen bg-orange-100">
            @if(!Request::is('home'))
            <a href="{{ route('home') }}" class="flex w-1/4 bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 border border-amber-700 rounded m-2">&lt; Back</a>
            @endif
            {{ $slot }}
        </div>
    </body>

</html>
