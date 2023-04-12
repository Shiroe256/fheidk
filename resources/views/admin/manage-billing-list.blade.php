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
                                    <div class="col align-self-end mb-2"><button id="btn_manage_billing_list_search" class="btn btn-outline-info btn-block border rounded-pill border-info" type="button"><i class="fas fa-search"></i>Search</button></div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-bordered my-0" id="tbl_manage_billing_list">
                                <thead>
                                    <tr>
                                        <th>REGION</th>
                                        <th>HEI NAME</th>
                                        <th>REFERENCE NO.</th>
                                        <th class="text-right">BENEFICIARIES</th>
                                        <th class="text-right">AMOUNT</th>
                                        <th>STATUS</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($billings as $billing)
                                        <tr>
                                            <td>{{ $billing->hei->hei_region_nir }}</td>
                                            <td>{{ $billing->hei->hei_name }}</td>
                                            <td>{{ $billing->reference_no }}</td>
                                            <td class="text-right">{{ $billing->total_beneficiaries }}</td>
                                            <td class="text-right">{{ $billing->total_amount }}</td>
                                            
                                            <td>
                                            <?php
                                                if($billing->billing_status==1):?>
                                            <span class="badge badge-pill badge-secondary span-size">Open for Billing Uploads</span>
                                            <?php
                                                elseif ($billing->billing_status==2):?>
                                            <span class="badge badge-pill badge-info span-size">Ongoing Validation, please return once done</span>
                                            <?php
                                                elseif ($billing->billing_status==3):?>
                                            <span class="badge badge-pill badge-primary span-size">Done Validating: Ready For Submission</span>
                                            <?php
                                                elseif ($billing->billing_status==4):?>
                                            <span class="badge badge-pill badge-danger span-size">Done Validating: For Review</span>
                                            <?php
                                                elseif ($billing->billing_status==5):?>
                                            <span class="badge badge-pill badge-warning span-size">Submitted to UniFAST: Billing Unit</span>
                                            <?php
                                                elseif ($billing->billing_status==6):?>
                                            <span class="badge badge-pill badge-warning span-size">Submitted to UniFAST: Admin Unit</span>
                                            <?php
                                                elseif ($billing->billing_status==7):?>
                                            <span class="badge badge-pill badge-warning span-size">Submitted to CHED-AFMS</span>
                                            <?php
                                                elseif ($billing->billing_status==8):?>
                                            <span class="badge badge-pill badge-success span-size">Disbursed</span>
                                            <?php
                                                endif;?>
                                            </td>
                                            <td>
                                                <a href="{{ route('managebillingpage', $billing->uid) }}" class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button"></i>View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>REGION</strong><br></td>
                                        <td><strong>HEI NAME</strong><br></td>
                                        <td><strong>REFERENCE NO.</strong><br></td>
                                        <td class="text-right"><strong>BENEFICIARIES</strong></td>
                                        <td class="text-right"><strong>AMOUNT</strong></td>
                                        <td><strong>STATUS</strong></td>
                                        <td class="text-center"><strong>ACTION</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@include('admin.includes.modal')    
@include('admin.includes.footer')