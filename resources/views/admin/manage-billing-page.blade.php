@include('admin.includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img width="50px" height="50px" src="{{url('img/UnifastLogo.png')}}">&nbsp;FHE ABS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('managebillinglist')}}">Manage Billing</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('manageuserslist')}}">Manage users</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="nav-item dropdown"><a aria-expanded="false" data-toggle="dropdown" class="nav-link" href="#">Carlo molina&nbsp;</a>
                            <div class="dropdown-menu"><a class="dropdown-item navbar-dropdown" data-toggle="modal" data-target="#modal_profile" href="#"><i class="fas fa-user"></i>&nbsp; &nbsp;Profile</a>
                                <div class="dropdown-divider">
                                </div>
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
                    <h4 class="text-left text-info">{{ strtoupper($billing->hei->hei_name) }}</h4>
                    <input type="hidden" name="uid" id="uid" value="{{ $billing->uid }}">
                    <input type="hidden" name="reference_no" id="reference_no" value="{{ $billing->reference_no }}">
                </div>
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold m-0">Billing Submissions</h6><a class="btn btn-outline-dark btn-sm" role="button" href="{{route('managebillinglist')}}">GO TO LIST OF BILLINGS</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 offset-xl-0">
                                <section class="clean-block payment-form">
                                    <div class="container-fluid">
                                        <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                            <table class="table table-bordered table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>BILLING DOCUMENTS</th>
                                                    <th>STATUS</th>
                                                    <th>REMARKS</th>
                                                    <th class="text-center">ACTION</th>
                                                </tr>
                                            </thead>
                                              <tbody>
                                                    <tr>
                                                        <td>Consolidated Billing Statement (Form 1)</td>
                                                        <td><span class="badge badge-pill badge-warning billing-status-badge">For Review</span></td>
                                                        <td></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info btn-sm" data-toggle="modal" data-bss-tooltip="" type="button" data-target="#modal_form_1" title="View Form 1 Scanned Copy"><i class="far fa-file-alt"></i></button><a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" data-bss-tooltip="" title="View Form 1 List" href="{{route('form1', $billing->uid)}}"><i class="fas fa-list"></i></a></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Consolidated Billing Details (Form 2)</td>
                                                        <td><span class="badge badge-pill badge-success billing-status-badge">Approved by UniFAST Billing Unit</span></td>
                                                        <td></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info btn-sm" data-toggle="modal" data-bss-tooltip="" type="button" data-target="#modal_form_1" title="View Form 2 Scanned Copy"><i class="far fa-file-alt"></i></button><a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" data-bss-tooltip="" title="View Form 2 List" href="{{route('form2')}}"><i class="fas fa-list"></i></a></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Consolidated Billing Details (Form 3)</td>
                                                        <td><span class="badge badge-pill badge-danger billing-status-badge">Rejected</span></td>
                                                        <td>Did not match with the submitted hard copy</td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info btn-sm" data-toggle="modal" data-bss-tooltip="" type="button" data-target="#modal_form_1" title="View Form 3 Scanned Copy"><i class="far fa-file-alt"></i></button><a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" data-bss-tooltip="" title="View Form 3 List" href="{{route('form3')}}"><i class="fas fa-list"></i></a></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Notarized Registrar's Certification</td>
                                                        <td><span class="badge badge-pill badge-danger billing-status-badge">Rejected</span></td>
                                                        <td>Did not match with the submitted hard copy</td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info btn-sm" data-toggle="modal" data-bss-tooltip="" type="button" data-target="#modal_form_1" title="View Scanned Copy"><i class="far fa-file-alt"></i></button></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bank Certification of the HEI Certified by the HEI</td>
                                                        <td><span class="badge badge-pill badge-danger billing-status-badge">Rejected</span></td>
                                                        <td>Did not match with the submitted hard copy</td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info btn-sm" data-toggle="modal" data-bss-tooltip="" type="button" data-target="#modal_form_1" title="View Scanned Copy"><i class="far fa-file-alt"></i></button></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bank Certification of the HEI Certified by the Bank</td>
                                                        <td><span class="badge badge-pill badge-danger billing-status-badge">Rejected</span></td>
                                                        <td>Did not match with the submitted hard copy</td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info btn-sm" data-toggle="modal" data-bss-tooltip="" type="button" data-target="#modal_form_1" title="View Scanned Copy"><i class="far fa-file-alt"></i></button></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end align-items-end">
                        <div class="btn-group" role="group"><a class="btn btn-outline-danger btn-sm" role="button">FOR REVISION OF THE HEI</a><a class="btn btn-outline-success btn-sm" role="button">FORWARD TO CHED-AFMS</a></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
@include('admin.includes.modal')
@include('admin.includes.footer')