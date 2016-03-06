<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>Интерактивный образовательный портал</title>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" type="text/css">
    <link rel="shortcut icon" href="{{ URL::asset('images/unnamed.png') }}" type="image/x-icon">
</head>

<body>

    @yield('index')
    {{--@yield('regist')--}}

    @yield('courses')
    @yield('newcourse')
    @yield('lections')

    <script type="text/javascript" src="{{ URL::asset('js/jquery-1.12.0.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/test.js') }}"></script>
</body>
</html>