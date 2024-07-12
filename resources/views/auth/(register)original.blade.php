@extends('layouts.app')

@section('content')
    <div class="container registration">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account</h4>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="input-style-tabs">HEI UII</label>
                                    <input class="form-control form-control-user @error('hei_uii') is-invalid @enderror" type="text" id="hei_uii" name="hei_uii" value="{{ old('hei_uii') }}" placeholder="HEI UII">

                                    @error('hei_uii')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group"><label class="input-style-tabs">FULL NAME</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input class="form-control form-control-user @error('fhe_focal_lname') is-invalid @enderror" type="text" id="fhe_focal_lname" placeholder="Last Name" name="fhe_focal_lname" value="{{ old('fhe_focal_lname') }}">

                                                @error('fhe_focal_lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input class="form-control form-control-user @error('fhe_focal_fname') is-invalid @enderror" type="text" id="fhe_focal_fname" placeholder="First Name" name="fhe_focal_fname" value="{{ old('fhe_focal_fname') }}">

                                                @error('fhe_focal_fname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input class="form-control form-control-user @error('fhe_focal_mname') is-invalid @enderror" type="text" id="fhe_focal_mname" placeholder="Middle Name" name="fhe_focal_mname" value="{{ old('fhe_focal_mname') }}">

                                                @error('fhe_focal_mname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="input-style-tabs">CONTACT INFORMATION</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control form-control-user @error('contact_number') is-invalid @enderror" type="number" id="contact_number" name="contact_number" placeholder="Contact Number" value="{{ old('contact_number') }}" required autocomplete="contact_number">

                                            @error('contact_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col">
                                            <input class="form-control form-control-user @error('email') is-invalid @enderror" type="email" id="email" name="email" aria-describedby="emailHelp" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col"><input class="form-control form-control-user @error('password') is-invalid @enderror" type="password" id="password" placeholder="Password" name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="col"><input class="form-control form-control-user" type="password" id="password-confirm" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password"></div>
                                    </div>
                                </div><button class="btn btn-primary btn-block text-white btn-user" type="submit">Register Account</button>
                                <hr>
                            </form>
                            <div class="text-center"><a class="small" href="{{ route('login') }}">Already have an account? Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
