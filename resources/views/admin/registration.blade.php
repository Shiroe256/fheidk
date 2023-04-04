@include('admin.includes.header')

<body>
    <section class="contact-clean">
        <form class="border rounded" method="post">
            <div class="form-group">
                <h3 class="text-center">SIGN UP</h3>
            </div>
            <div class="form-group"><input class="border rounded form-control" type="text" placeholder="Last Name" required=""></div>
            <div class="form-group"><input class="border rounded form-control" type="text" placeholder="First Name" required=""></div>
            <div class="form-group"><input class="border rounded form-control" type="text" placeholder="Middle Name" required=""></div>
            <div class="form-group"><input class="border rounded form-control" type="text" placeholder="Contact Number" required="" pattern="^(09|\+639)\d{9}$"></div>
            <div class="form-group"><input class="border rounded form-control" type="email" placeholder="Email" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"></div>
            <div class="form-group"><input class="border rounded form-control" type="password" id="myInputy" placeholder="Password" required=""></div>
            <div class="form-group"><input class="border rounded form-control" type="password" id="myInputz" placeholder="Password (repeat)" required=""></div>
            <div class="form-group">
                <div class="custom-control text-left custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1" onclick="myFunction2()"><label class="custom-control-label" for="formCheck-1">Show Password<br></label></div>
            </div>
            <div class="form-group"><button class="btn btn-success btn-block border rounded btn-signup" type="submit">sign up</button></div>
            <div class="form-group text-center"><a class="contact-clean-link" href="index.php">Already have an account? Login here.</a></div>
        </form>
    </section>

@include('admin.includes.authfooter')