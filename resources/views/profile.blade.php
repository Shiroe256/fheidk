@include('includes.header')
            <div class="container-fluid">
                <h4 class="text-dark mb-4">Higher Education Institution Profile</h4>
                <div class="row mb-3">
                    <div class="col-lg-5 col-xl-5">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">FHE Focal Person Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <div id="avatar_div" class="form-group text-center">
                                            <img class="square rounded" 
                                            @if(is_null(Auth::user()->avatar))
                                            src="{{url('storage\images\user.png')}}"
                                            @else
                                            src="{{url('storage\images').('/').Auth::user()->avatar}}"
                                            @endif
                                            width="160" height="160">
                                        </div>
                                        <form id='frm_update_user' method="POST">
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col"><label class="col-form-label"><strong>Avatar</strong></label></div>
                                                </div>
                                                <div class="form-row">
                                                    <input type="hidden" name="user_avatar" id="user_avatar">
                                                    <div class="col"><input type="file" id="avatar" name="avatar" ></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label><strong>Last Name</strong></label><input id="fhe_focal_lname" name="fhe_focal_lname" class="form-control" type="text"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label><strong>First Name</strong></label><input id="fhe_focal_fname" name="fhe_focal_fname" class="form-control" type="text"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label><strong>Middle Name</strong></label><input id="fhe_focal_mname" name="fhe_focal_mname" class="form-control" type="text"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label><strong>Email</strong></label><input id="email" name="email" class="form-control" type="text"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label><strong>Contact</strong></label><input id="contact" name="contact" class="form-control" type="number"></div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right">
                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-primary" type="submit">Update Settings</button></div>
                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-primary" type="button">Reset Password</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-7">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">HEI Information</p>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label><strong>HEI UII</strong><br></label><input id="hei_uii" name="hei_uii" class="form-control" type="text"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label><strong>HEI Name</strong></label><input id="hei_name" name="hei_name" class="form-control" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label><strong>HEI Address</strong><br></label><input id="hei_address" name="hei_address" class="form-control" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label><strong>HEI Email</strong></label><input id="hei_email" name="hei_email" class="form-control" type="email"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label><strong>HEI Contact</strong></label><input id="hei_contact" name="hei_contact" class="form-control" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label><strong>Website</strong></label><input id="hei_website" name="hei_website" class="form-control" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label><strong>Name of HEI President</strong></label><input id="hei_president_name" name="hei_president_name" class="form-control" type="text"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label><strong>Email</strong></label><input id="hei_president_email" name="hei_president_email" class="form-control" type="email"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label><strong>Contact</strong></label><input id="hei_president_contact" name="hei_president_contact" class="form-control" type="number"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © FHE Portal 2022</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
</body>
@include('includes.footer')
<script type="text/javascript" src="{{url('js\user.js')}}"></script>
</html>