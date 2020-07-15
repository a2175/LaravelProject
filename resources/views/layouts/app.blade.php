<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/common.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
</head>
<body>
    <header id="header">
        <div>
            <div id="logo">
                <h3><a href="{{ route('home') }}">LARAVEL HOMPAGE</a></h3>
            </div>
        </div>
        <nav id="gnb">
            <ul>
                <li><a href="{{ route('post.index') }}">게시판</a></li>
                <li><a href="/">채팅</a></li>
            </ul>
        </nav>
    </header>

    @yield('content')

    <footer id="footer">
        copyright (c) 2017 Junil-hwang all right reserved.
    </footer>
</body>
</html>
