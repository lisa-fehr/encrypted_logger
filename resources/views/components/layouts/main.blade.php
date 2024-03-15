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
            {{ $slot }}
        </div>
    </body>

</html>
