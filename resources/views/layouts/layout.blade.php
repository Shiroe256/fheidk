<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('header')
</head>

<body id="particles-js">
    @yield('content')
    @yield('footer')
</body>

</html>
