<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title', 'Liber - Home')</title>
</head>
<body class="bg-black">
    <div>
        @include('layouts.nav')
        @yield('content')
    </div>
</body>
</html>
