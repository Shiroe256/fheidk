@include('admin.includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img width="50px" height="50px" src="{{url('img/UnifastLogo.png')}}">&nbsp;FHE ABS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{route('managebillinglist')}}">Manage Billing</a></li>
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
                    <h4 class="text-left text-info">MANAGE BILLING</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold m-0">List of Billings</h6>
                    </div>
                    <div class="card-body">
                        <form id="manage_billing_list_form">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-lg-3 col-xl-3 mb-2"><label>Academic Year</label>
                                        <select class="form-control" id="select_ac_year">
                                            <optgroup label="--Select Academic Year--">
                                                <option value="All" selected="">All</option>
                                                <option value="2022-2023">2022-2023</option>
                                            </optgroup>
                                        </select></div>
                                    <div class="col-lg-3 col-xl-3 mb-2"><label>Semester</label>
                                        <select class="form-control"  id="select_semester">
                                            <optgroup label="--Select Semester--">
                                                <option value="All" selected="">All</option>
                                                <option value="1st">1st</option>
                                                <option value="2nd">2nd</option>
                                                <option value="3rd">3rd</option>
                                            </optgroup>
                                        </select></div>
                                    <div class="col-lg-3 col-xl-3 mb-2"><label>Billing Status</label>
                                        <select class="form-control"  id="select_billing_status">
                                            <optgroup label="--Select Billing Status--">
                                                <option value="All" selected="">All</option>
                                                <option value="5">Submitted to UniFAST: Billing Unit</option>
                                                <option value="6">Submitted to UniFAST: Admin Unit</option>
                                                <option value="7">Submitted to CHED-AFMS</option>
                                                <option value="8">Disbursed</option>
                                            </optgroup>
                                        </select></div>
                                    <div class="col align-self-end mb-2"><button id="btn_manage_billing_list_search" class="btn btn-outline-info btn-block border rounded-pill border-info" type="button" onclick="managebillinglistsearch()"><i class="fas fa-search"></i>Search</button></div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive table-bordered table mt-2" id="tbl_billing_list_admin" role="grid" aria-describedby="dataTable_info">
                            <!---Billing List Here--->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@include('admin.includes.modal')    
@include('admin.includes.footer')