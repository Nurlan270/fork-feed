<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <title>
        @if(Route::is('welcome'))
            ForkFeed - Cook. Share. Connect.
        @else
            @yield('page.title') | {{ config('app.name') }}
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @bukStyles
    @stack('styles')
</head>
<body class="bg-gray-50">
    <x-navbar />

    @yield('content')

    <x-footer />
    @bukScripts
    @stack('scripts')
</body>
</html>
