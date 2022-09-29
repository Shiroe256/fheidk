<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" type="text/css" href="{{url('css\bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('css\style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('fonts\fontawesome-all.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('fonts\font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('fonts\fontawesome5-overrides.min.css')}}"/>
    
</head>
<body id="particles-js" class="bg-gradient-primary">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="p-5">
                    <form id="login_form" class="user" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <div class="text-center"><img src="{{url('img\UnifastLogo.png')}}" style="width: 200px;"></div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <h5 class="text-dark mb-4">FREE HIGHER EDUCATION PORTAL</h5>
                            </div>
                        </div>
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text icon-container"><i class="fas fa-user "></i></span>
                                </div>
                                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text icon-container"><i onclick="myFunction(this)" class="far fa-eye"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <script>
                            function myFunction(x) {
                              x.classList.toggle("fa-eye-slash");
                              if(x.classList.contains("fa-eye-slash")){
                                $('#password').attr('type', 'text');
                              }else{
                                $('#password').attr('type', 'password');
                              }
                            }
                        </script>
                      
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <div class="form-check">
                                    <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label custom-control-label" for="remember">Remember Password</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block text-white btn-user" role="button" type="submit">Login</button>
                        <hr>
                        <div class="text-center"><a class="small" href="{{ route('password.request') }}">Forgot Password?</a></div>
                        <div class="text-center"><a class="small" href="{{ route('register') }}">Register</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="{{url('js\jquery.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js')}}"></script>
<script type="text/javascript" src="{{url('js\chart.min.js')}}"></script>
<script type="text/javascript" src="{{url('js\showandhide.js')}}"></script>
<script type="text/javascript" src="{{url('js\bs-init.js')}}"></script>
<script type="text/javascript" src="{{url('js\bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('js\particles\particles.js')}}"></script>
<script type="text/javascript" src="{{url('js\particles\app.js')}}"></script>
</html>