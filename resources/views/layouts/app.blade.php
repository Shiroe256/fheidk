<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" type="text/css" href="{{url('css\bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('css\style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('fonts\fontawesome-all.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('fonts\font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('fonts\fontawesome5-overrides.min.css')}}"/>
    
</head>

<body>
    <body class="bg-gradient-primary">
        <main class="py-4">
            <div id="particles-js">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript" src="{{url('js\jquery.min.js')}}"></script>
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js')}}"></script>
    <script type="text/javascript" src="{{url('js\chart.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js\showandhide.js')}}"></script>
    <script type="text/javascript" src="{{url('js\bs-init.js')}}"></script>
    <script type="text/javascript" src="{{url('js\bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js\particles\particles.js')}}"></script>
    <script type="text/javascript" src="{{url('js\particles\app.js')}}"></script>
</body>

</html>
