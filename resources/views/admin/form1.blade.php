@include('includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img width="50px" height="50px" src="{{url('img/UnifastLogo.png')}}">&nbsp;FHE ABS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('managebillinglist')}}">Manage Billing</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('manageuserslist')}}">Manage Users</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="nav-item dropdown"><a aria-expanded="false" data-toggle="dropdown" class="nav-link" href="#">Carlo molina&nbsp;</a>
                            <div class="dropdown-menu"><a class="dropdown-item navbar-dropdown" data-toggle="modal" data-target="#modal_profile" href="#"><i class="fas fa-user"></i>&nbsp; &nbsp;Profile</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item navbar-dropdown" href="index.php"><i class="fas fa-sign-out-alt"></i>&nbsp; &nbsp;Log out</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container-fluid">
                <div class="block-heading">
                    <h4 class="text-left text-info">ILOCOS SUR POLYTECHNIC COLLEGE OF THE PHILIPPINES</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold m-0">Billing Form 1 ( Billing Statement)</h6><a class="btn btn-outline-dark btn-sm" role="button" href="manage-billing-hei-submission-page.php">RETURN TO THE LIST OF SUBMISSIONS</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <section class="clean-block payment-form">
                                    <div class="container">
                                        <form>
                                            <div class="card-details">
                                                <h3 class="title">Billing Statement</h3>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="item-description font-weight-bold">Ilocos Sur Polytechnic College</p>
                                                        <p class="item-description font-weight-bold">123,456.00</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-details pt-0">
                                                <h3 class="title">Breakdown</h3>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Admission Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Entrance Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Athletic Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Cultural Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Computer Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Development Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Library Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Laboratory Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Guidance Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Handbook Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Medical and Dental Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">Registration Fee</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col d-flex justify-content-between">
                                                        <p class="text-muted item-description">School ID</p>
                                                        <p class="text-muted item-description">123,456.00</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end align-items-end">
                        <div class="btn-group" role="group"><a class="btn btn-outline-danger btn-sm" role="button" data-toggle="modal" data-target="#modal_reject">REJECT</a><a class="btn btn-outline-success btn-sm" role="button" data-toggle="modal" data-target="#modal_approve">APPROVE</a></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
@include('includes.modal')
@include('includes.footer')
