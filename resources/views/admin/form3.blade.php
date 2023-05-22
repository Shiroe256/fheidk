@include('admin.includes.header')

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
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
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
                        <h6 class="font-weight-bold m-0">Billing Form 3 (Admission / Entrance Exam)</h6><a class="btn btn-outline-dark btn-sm" role="button" href="{{route('managebillingpage', $billing->reference_no)}}">RETURN TO THE LIST OF SUBMISSIONS</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-bordered my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox"></th>
                                        <th>APP ID</th>
                                        <th>FULL NAME</th>
                                        <th>COURSE APPLIED</th>
                                        <th class="text-center">YEAR</th>
                                        <th class="text-left">REMARKS</th>
                                        <th class="text-center">TOTAL EXAM</th>
                                        <th class="text-right">AMOUNT</th>
                                        <th>RESULT</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><input type="checkbox"></td>
                                        <td>01-2022-2023-12345</td>
                                        <td>Molina, Carlo E.</td>
                                        <td>Bachelor of Science in Information and Technology</td>
                                        <td class="text-center">1<br></td>
                                        <td class="text-left">Valedictorian in High School</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">43,000.00</td>
                                        <td><span class="badge badge-pill badge-danger billing-status-badge">Failed<br></span></td>
                                        <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#modal_2">View</button></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><input type="checkbox"></td>
                                        <td>01-2022-2023-12345</td>
                                        <td>Molina, Carlo E.</td>
                                        <td>Bachelor of Science in Information and Technology</td>
                                        <td class="text-center">1<br></td>
                                        <td class="text-left">Valedictorian in High School</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">43,000.00</td>
                                        <td><span class="badge badge-pill badge-success billing-status-badge">Passed<br></span></td>
                                        <td class="text-center"><a class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button" href="manage-billing-hei-submission-form1.php">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end align-items-end">
                        <div class="btn-group" role="group"><a class="btn btn-outline-danger btn-sm" role="button">REJECT</a><a class="btn btn-outline-success btn-sm" role="button">APPROVE</a><a class="btn btn-outline-primary btn-sm d-none" role="button">FOR PREPARATION OF LDDAP-ADA</a><a class="btn btn-outline-success btn-sm d-none" role="button">PAID VIA LDDAP-ADA</a></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@include('admin.includes.modal')
@include('admin.includes.footer')