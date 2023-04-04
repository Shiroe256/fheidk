@include('includes.header')

<body>
    <section class="contact-clean">
        <form class="border rounded" method="post">
            <div class="form-group text-center"><img class="img-fluid" src="{{url('img/UnifastLogo.png')}}" width="175" height="175"></div>
            <div class="form-group">
                <h3 class="text-center">FHE BILLING SYSTEM</h3>
            </div>
            <div class="form-group"><input class="border rounded form-control" type="email" placeholder="Email"></div>
            <div class="form-group"><input class="border rounded form-control" type="password" id="myInputx" placeholder="Password"></div>
            <div class="form-group">
                <div class="custom-control text-left custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1" onclick="myFunction()"><label class="custom-control-label" for="formCheck-1">Show Password<br></label></div>
            </div>
            <div class="form-group"><a class="btn btn-primary btn-block border rounded" role="button" href="{{route('dashboard')}}">log in</a></div>
            <div class="form-group"><a class="btn btn-success btn-block border rounded" role="button" href="registration.php" style="background: rgb(92, 184, 92);">sign up</a></div>
            <div class="form-group text-center"><a class="contact-clean-link already" href="#">Forgot Password?</a></div>
        </form>
    </section>

@include('includes.authfooter')