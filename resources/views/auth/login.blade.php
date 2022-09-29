@extends('layouts.app')

@section('content')
    <div id="particles-js" class="container">
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
    @endsection