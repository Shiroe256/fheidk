@include('admin.includes.header')

<body>
    <nav class="navbar navbar-light navbar-expand-md clean-navbar">
        <div class="container-fluid"><a class="navbar-brand logo" href="#" style="font-weight: bold;"><img width="50px" height="50px" src="{{url('img/UnifastLogo.png')}}">&nbsp;FHE ABS</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('admindashboard')}}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('managebillinglist')}}">Manage Billing</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('manageuserslist')}}">Manage users</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="nav-item dropdown"><a aria-expanded="false" data-toggle="dropdown" class="nav-link" href="#">{{ Auth::user()->fhe_focal_fname . ' ' . Auth::user()->fhe_focal_mname . ' ' . Auth::user()->fhe_focal_lname }}</a>
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
                                                    <th>LINK</th>
                                                    <th>STATUS</th>
                                                    <th>REMARKS</th>
                                                    <th class="text-center">VIEW</th>
                                                    <th class="text-center">ACTION</th>
                                                </tr>
                                            </thead>
                                              <tbody>
                                                    <tr>
                                                        <td>Consolidated Billing Statement (Form 1)</td>
                                                        <td><a href="{{ $billing->form1_link }}"
                                                            target="_blank">{{ $billing->form1_link }}</a></td>
                                                        <td>
                                                        @if ($billing->form1_status == 0)
                                                            <span class="badge badge-pill badge-secondary input-style">No
                                                                Attachment</span>
                                                        @elseif ($billing->form1_status == 1)
                                                            <span class="badge badge-pill badge-warning input-style">For
                                                                Review</span>
                                                        @elseif ($billing->form1_status == 2)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->form1_status == 3)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->form1_status == 4)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by CHED-AFMS</span>
                                                        @elseif ($billing->form1_status == 5)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by CHED-AFMS</span>
                                                        @endif
                                                        </td>
                                                        <td>{{ $billing->form1_remarks }}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                                data-placement="bottom" title="View billing submission"
                                                                href="{{ $billing->form1_link }}" target="_blank"><i class="far fa-file-alt"></i></a>
                                                                <a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" data-bss-tooltip="" title="View Form 1 List" href="{{route('form1', $billing->reference_no)}}"><i class="fas fa-list"></i></a>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div role="group" class="btn-group btn-group-sm">
                                                                <button class="btn btn-outline-success btn-sm" title="Approve"><i class="fas fa-check"></i></button>
                                                                <button class="btn btn-outline-danger btn-sm" title="Reject"><i class="fas fa-times"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Consolidated Billing Details (Form 2)</td>
                                                        <td><a href="{{ $billing->form2_link }}"
                                                            target="_blank">{{ $billing->form2_link }}</a></td>
                                                        <td>
                                                        @if ($billing->form2_status == 0)
                                                            <span class="badge badge-pill badge-secondary input-style">No
                                                                Attachment</span>
                                                        @elseif ($billing->form2_status == 1)
                                                            <span class="badge badge-pill badge-warning input-style">For
                                                                Review</span>
                                                        @elseif ($billing->form2_status == 2)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->form2_status == 3)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->form2_status == 4)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by CHED-AFMS</span>
                                                        @elseif ($billing->form2_status == 5)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by CHED-AFMS</span>
                                                        @endif
                                                        </td>
                                                        <td>{{ $billing->form2_remarks }}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                                data-placement="bottom" title="View billing submission"
                                                                href="{{ $billing->form2_link }}" target="_blank"><i class="far fa-file-alt"></i></a>
                                                                <a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" data-bss-tooltip="" title="View Form 2 List" href="{{route('form2', $billing->reference_no)}}"><i class="fas fa-list"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Consolidated Billing Details (Form 3)</td>
                                                        <td><a href="{{ $billing->form3_link }}"
                                                            target="_blank">{{ $billing->form3_link }}</a></td>
                                                        <td>
                                                        @if ($billing->form3_status == 0)
                                                            <span class="badge badge-pill badge-secondary input-style">No
                                                                Attachment</span>
                                                        @elseif ($billing->form3_status == 1)
                                                            <span class="badge badge-pill badge-warning input-style">For
                                                                Review</span>
                                                        @elseif ($billing->form3_status == 2)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->form3_status == 3)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->form3_status == 4)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by CHED-AFMS</span>
                                                        @elseif ($billing->form3_status == 5)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by CHED-AFMS</span>
                                                        @endif
                                                        </td>
                                                        <td>{{ $billing->form3_remarks }}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                                data-placement="bottom" title="View billing submission"
                                                                href="{{ $billing->form3_link }}" target="_blank"><i class="far fa-file-alt"></i></a><a class="btn btn-outline-info btn-sm" role="button" data-toggle="tooltip" data-bss-tooltip="" title="View Form 3 List" href="{{route('form3', $billing->reference_no)}}"><i class="fas fa-list"></i></a></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Notarized Registrar's Certification</td>
                                                        <td class="text-left"> <a href="{{ $billing->reg_cert_link }}"
                                                            target="_blank">{{ $billing->reg_cert_link }}</a></td>
                                                    <td>
                                                        @if ($billing->reg_cert_status == 0)
                                                            <span class="badge badge-pill badge-secondary input-style">No
                                                                Attachment</span>
                                                        @elseif ($billing->reg_cert_status == 1)
                                                            <span class="badge badge-pill badge-warning input-style">For
                                                                Review</span>
                                                        @elseif ($billing->reg_cert_status == 2)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->reg_cert_status == 3)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->reg_cert_status == 4)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by CHED-AFMS</span>
                                                        @elseif ($billing->reg_cert_status == 5)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by CHED-AFMS</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $billing->reg_cert_remarks }}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billing->reg_cert_link }}" target="_blank"><i class="far fa-file-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Certificate of Registration of Students (CORs)</td>
                                                        <td class="text-left"> <a href="{{ $billing->cor_link }}"
                                                            target="_blank">{{ $billing->cor_link }}</a></td>
                                                    <td>
                                                        @if ($billing->cor_status == 0)
                                                            <span class="badge badge-pill badge-secondary input-style">No
                                                                Attachment</span>
                                                        @elseif ($billing->cor_status == 1)
                                                            <span class="badge badge-pill badge-warning input-style">For
                                                                Review</span>
                                                        @elseif ($billing->cor_status == 2)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->cor_status == 3)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->cor_status == 4)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by CHED-AFMS</span>
                                                        @elseif ($billing->cor_status == 5)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by CHED-AFMS</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $billing->cor_remarks }}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billing->cor_link }}" target="_blank"><i class="far fa-file-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bank Certification of the HEI Certified by the HEI</td>
                                                        <td class="text-left"> <a href="{{ $billing->hei_bank_cert_link }}"
                                                            target="_blank">{{ $billing->hei_bank_cert_link }}</a></td>
                                                    <td>
                                                        @if ($billing->hei_bank_cert_status == 0)
                                                            <span class="badge badge-pill badge-secondary input-style">No
                                                                Attachment</span>
                                                        @elseif ($billing->hei_bank_cert_status == 1)
                                                            <span class="badge badge-pill badge-warning input-style">For
                                                                Review</span>
                                                        @elseif ($billing->hei_bank_cert_status == 2)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->hei_bank_cert_status == 3)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->hei_bank_cert_status == 4)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by CHED-AFMS</span>
                                                        @elseif ($billing->hei_bank_cert_status == 5)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by CHED-AFMS</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $billing->hei_bank_cert_remarks }}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billing->hei_bank_cert_link }}" target="_blank"><i class="far fa-file-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bank Certification of the HEI Certified by the Bank</td>
                                                        <td class="text-left"> <a href="{{ $billing->bank_cert_link }}"
                                                            target="_blank">{{ $billing->bank_cert_link }}</a></td>
                                                    <td>
                                                        @if ($billing->bank_cert_status == 0)
                                                            <span class="badge badge-pill badge-secondary input-style">No
                                                                Attachment</span>
                                                        @elseif ($billing->bank_cert_status == 1)
                                                            <span class="badge badge-pill badge-warning input-style">For
                                                                Review</span>
                                                        @elseif ($billing->bank_cert_status == 2)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->bank_cert_status == 3)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by UniFAST Billing Unit</span>
                                                        @elseif ($billing->bank_cert_status == 4)
                                                            <span
                                                                class="badge badge-pill badge-success input-style">Approved
                                                                by CHED-AFMS</span>
                                                        @elseif ($billing->bank_cert_status == 5)
                                                            <span class="badge badge-pill badge-danger input-style">Rejected
                                                                by CHED-AFMS</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $billing->bank_cert_remarks }}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billing->bank_cert_link }}" target="_blank"><i class="far fa-file-alt"></i></a>
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
                        <div class="btn-group" role="group">
                            <button id="btn_revision_to_hei" name="btn_revision_to_hei" class="btn btn-outline-danger btn-sm" type="button">FOR REVISION TO HEI</button>
                            <button id="btn_forward_to_afms" name="btn_forward_to_afms" class="btn btn-outline-success btn-sm" type="button">FORWARD TO CHED-AFMS</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
@include('admin.includes.modal')
@include('admin.includes.footer')
<script src="{{url('admin\js\managebillinglist.js')}}"></script>
</body>

</html>
