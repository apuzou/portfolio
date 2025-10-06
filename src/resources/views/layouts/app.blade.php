<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="前田聖太のポートフォリオサイト - フルスタックエンジニアとしてみなさまの課題解決へ">
    
    <title>@yield('title', 'apuzou\'s portfolio')</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    @yield('content')
    
    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
