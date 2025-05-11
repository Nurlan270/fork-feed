<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if(Route::is('welcome'))
            ForkFeed - Cook. Share. Connect.
        @else
            @yield('page.title') | {{ config('app.name') }}
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <x-navbar />

    @yield('content')

    <x-footer />
</body>
</html>
