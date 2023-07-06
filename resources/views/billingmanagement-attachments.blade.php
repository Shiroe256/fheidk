<?php $f = new NumberFormatter('en', NumberFormatter::ORDINAL); ?>
@include('includes.header')
<div class="container-fluid">
    <h6 class="text-dark mb-4">FHE Management / AY
        {{ $billings->ac_year }}&nbsp;/&nbsp;{{ $f->format($billings->semester) }}
        Semester / Reference No. {{ $billings->reference_no }}</h6>
    <input type="hidden" name="ac_year" id="ac_year" value="{{ $billings->ac_year }}">
    <input type="hidden" name="semester" id="semester" value="{{ $billings->semester }}">
    <input type="hidden" name="tranche" id="tranche" value="{{ $billings->tranche }}">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center"><a
                class="btn btn-outline-dark btn-sm" role="button" href="{{ route('billings') }}"><i
                    class="fas fa-arrow-left"></i>&nbsp;Return to the
                previous page</a>
            <div class="btn-group" role="group">
                <input type="hidden" id="reference_no" name="reference_no" value="{{ $billings->reference_no }}">
                <input type="hidden" id="billing_status" name="billing_status" value="{{ $billings->billing_status }}">
                <button id="btn_submit" class="btn btn-outline-primary btn-sm" type="button"
                    value="{{ $billings->reference_no }}"><i class="far fa-file-alt"></i>&nbsp;Submit for
                    Review</button>
            </div>
        </div>
        <div id="summary_billing_div" class="card-body summary_billing_div">
            <div id="summary_billing_div" class="card-body summary_billing_div">
                <div>
                    <ul class="nav nav-tabs nav-fill">
                        <li class="nav-item"><a class="nav-link active input-style-tabs" role="tab"
                                data-toggle="tab" href="#generate_billing_forms">GENERATE BILLING FORMS</a></li>
                        {{-- For later use --}}
                        {{-- <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab"
                href="#form2">BILLING DETAILS (FORM 2)</a></li> 
        <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab"
                href="#form2">BILLING DETAILS (FORM 3)</a></li>                --}}
                        <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab"
                                href="#submit_billing">SUBMIT FINAL BILLING</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" role="tabpanel" id="generate_billing_forms">
                            <form class="mt-4">
                                <div class="form-group input-style">
                                    <div class="form-row">
                                        <div class="col-lg-3 col-xl-4">
                                            <h5 class="text-black-50 mb-4"><i class="fas fa-suitcase"></i>&nbsp;Billing
                                                Summary</h5>
                                        </div>
                                        <div class="col text-right">
                                            <div class="btn-group" role="group"><button
                                                    class="btn btn-outline-primary btn-sm" type="button"><i
                                                        class="fas fa-file-download"></i>&nbsp;Download Generated
                                                    Forms</button></div>
                                        </div>
                                    </div>
                                    <div id="show_summary_for_billing"
                                        class="table-responsive table-style mt-2 show_summary" role="grid"
                                        aria-describedby="dataTable_info">
                                        {{-- SUMMARY TABLE HERE --}}
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" role="tabpanel" id="submit_billing">
                            <form class="mt-4">
                                <h5 class="text-black-50 mb-4"><i class="fas fa-paperclip"></i></i>&nbsp;Attach Billing
                                    Requirements
                                </h5>

                                <div class="table-responsive mt-2 table-style" role="grid"
                                    aria-describedby="dataTable_info" id="tbl_billing_attachments_div">
                                    <table class="table table-bordered table-hover dataTable my-0 table-style"
                                        id="tbl_billing_attachments">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NO.</th>
                                                <th class="text-left">BILLING DOCUMENTS</th>
                                                <th class="text-left">LINK</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">REMARKS</th>
                                                <th class="text-center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-left">Consolidated Billing Statement (Form 1)</td>
                                                <td class="text-left"> <a href="{{ $billings->form1_link }}"
                                                        target="_blank">{{ $billings->form1_link }}</a></td>
                                                <td class="text-center">
                                                    @if ($billings->form1_status == 0)
                                                        <span class="badge badge-pill badge-secondary input-style">No
                                                            Attachment</span>
                                                    @elseif ($billings->form1_status == 1)
                                                        <span class="badge badge-pill badge-warning input-style">For
                                                            Review</span>
                                                    @elseif ($billings->form1_status == 2)
                                                        <span
                                                            class="badge badge-pill badge-success input-style">Approved
                                                            by UniFAST Billing Unit</span>
                                                    @elseif ($billings->form1_status == 3)
                                                        <span class="badge badge-pill badge-danger input-style">Rejected
                                                            by UniFAST Billing Unit</span>
                                                    @elseif ($billings->form1_status == 4)
                                                        <span
                                                            class="badge badge-pill badge-success input-style">Approved
                                                            by CHED-AFMS</span>
                                                    @elseif ($billings->form1_status == 5)
                                                        <span class="badge badge-pill badge-danger input-style">Rejected
                                                            by CHED-AFMS</span>
                                                    @endif
                                                </td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="{{ $billings->reference_no }}"
                                                            name="btn_link_form1"
                                                            class="btn_link_form1 btn btn-outline-info"
                                                            data-bs-toggle="modal" data-bs-tooltip=""
                                                            data-placement="bottom" type="button"
                                                            title="Attach link for form 1"
                                                            data-bs-target="#mod_upload_link_form1"><i
                                                                class="fas fa-paperclip"></i></button>
                                                        <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billings->form1_link }}" target="_blank"><i
                                                                class="far fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-left">Consolidated Billing Details (Form 2)</td>
                                                <td class="text-left"> <a href="{{ $billings->form2_link }}"
                                                    target="_blank">{{ $billings->form2_link }}</a></td>
                                            <td class="text-center">
                                                @if ($billings->form2_status == 0)
                                                    <span class="badge badge-pill badge-secondary input-style">No
                                                        Attachment</span>
                                                @elseif ($billings->form2_status == 1)
                                                    <span class="badge badge-pill badge-warning input-style">For
                                                        Review</span>
                                                @elseif ($billings->form2_status == 2)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->form2_status == 3)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->form2_status == 4)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by CHED-AFMS</span>
                                                @elseif ($billings->form2_status == 5)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by CHED-AFMS</span>
                                                @endif
                                            </td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="{{ $billings->reference_no }}"
                                                            name="btn_link_form2"
                                                            class="btn_link_form2 btn btn-outline-info"
                                                            data-bs-toggle="modal" data-bs-tooltip=""
                                                            data-placement="bottom" type="button"
                                                            title="Attach link for form 2"
                                                            data-bs-target="#mod_upload_link_form2"><i
                                                                class="fas fa-paperclip"></i></button>
                                                        <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billings->form2_link }}" target="_blank"><i
                                                                class="far fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-left">Consolidated Billing Details (Form 3)</td>
                                                <td class="text-left"> <a href="{{ $billings->form3_link }}"
                                                    target="_blank">{{ $billings->form3_link }}</a></td>
                                            <td class="text-center">
                                                @if ($billings->form3_status == 0)
                                                    <span class="badge badge-pill badge-secondary input-style">No
                                                        Attachment</span>
                                                @elseif ($billings->form3_status == 1)
                                                    <span class="badge badge-pill badge-warning input-style">For
                                                        Review</span>
                                                @elseif ($billings->form3_status == 2)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->form3_status == 3)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->form3_status == 4)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by CHED-AFMS</span>
                                                @elseif ($billings->form3_status == 5)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by CHED-AFMS</span>
                                                @endif
                                            </td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="{{ $billings->reference_no }}"
                                                            name="btn_link_form3"
                                                            class="btn_link_form3 btn btn-outline-info"
                                                            data-bs-toggle="modal" data-bs-tooltip=""
                                                            data-placement="bottom" type="button"
                                                            title="Attach link for form 3"
                                                            data-bs-target="#mod_upload_link_form3"><i
                                                                class="fas fa-paperclip"></i></button>
                                                        <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billings->form3_link }}" target="_blank"><i
                                                                class="far fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td class="text-left">Notarized Registrar's Certification</td>
                                                <td class="text-left"> <a href="{{ $billings->reg_cert_link }}"
                                                    target="_blank">{{ $billings->reg_cert_link }}</a></td>
                                            <td class="text-center">
                                                @if ($billings->reg_cert_status == 0)
                                                    <span class="badge badge-pill badge-secondary input-style">No
                                                        Attachment</span>
                                                @elseif ($billings->reg_cert_status == 1)
                                                    <span class="badge badge-pill badge-warning input-style">For
                                                        Review</span>
                                                @elseif ($billings->reg_cert_status == 2)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->reg_cert_status == 3)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->reg_cert_status == 4)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by CHED-AFMS</span>
                                                @elseif ($billings->reg_cert_status == 5)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by CHED-AFMS</span>
                                                @endif
                                            </td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="{{ $billings->reference_no }}"
                                                            name="btn_link_reg_cert"
                                                            class="btn_link_reg_cert btn btn-outline-info"
                                                            data-bs-toggle="modal" data-bs-tooltip=""
                                                            data-placement="bottom" type="button"
                                                            title="Attach link for registrar's certification"
                                                            data-bs-target="#mod_upload_link_reg_cert"><i
                                                                class="fas fa-paperclip"></i></button>
                                                        <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billings->reg_cert_link }}" target="_blank"><i
                                                                class="far fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td class="text-left">Certificate of Registration of Students (CORs)
                                                </td>
                                                <td class="text-left"> <a href="{{ $billings->cor_link }}"
                                                    target="_blank">{{ $billings->cor_link }}</a></td>
                                            <td class="text-center">
                                                @if ($billings->cor_status == 0)
                                                    <span class="badge badge-pill badge-secondary input-style">No
                                                        Attachment</span>
                                                @elseif ($billings->cor_status == 1)
                                                    <span class="badge badge-pill badge-warning input-style">For
                                                        Review</span>
                                                @elseif ($billings->cor_status == 2)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->cor_status == 3)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->cor_status == 4)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by CHED-AFMS</span>
                                                @elseif ($billings->cor_status == 5)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by CHED-AFMS</span>
                                                @endif
                                            </td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="{{ $billings->reference_no }}"
                                                            name="btn_link_cor"
                                                            class="btn_link_cor btn btn-outline-info"
                                                            data-bs-toggle="modal" data-bs-tooltip=""
                                                            data-placement="bottom" type="button"
                                                            title="Attach link for student cor's"
                                                            data-bs-target="#mod_upload_link_cor"><i
                                                                class="fas fa-paperclip"></i></button>
                                                        <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billings->cor_link }}" target="_blank"><i
                                                                class="far fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6</td>
                                                <td class="text-left">Bank Certification of the HEI Certified by the
                                                    HEI
                                                </td>
                                                <td class="text-left"> <a href="{{ $billings->hei_bank_cert_link }}"
                                                    target="_blank">{{ $billings->hei_bank_cert_link }}</a></td>
                                            <td class="text-center">
                                                @if ($billings->hei_bank_cert_status == 0)
                                                    <span class="badge badge-pill badge-secondary input-style">No
                                                        Attachment</span>
                                                @elseif ($billings->hei_bank_cert_status == 1)
                                                    <span class="badge badge-pill badge-warning input-style">For
                                                        Review</span>
                                                @elseif ($billings->hei_bank_cert_status == 2)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->hei_bank_cert_status == 3)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->hei_bank_cert_status == 4)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by CHED-AFMS</span>
                                                @elseif ($billings->hei_bank_cert_status == 5)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by CHED-AFMS</span>
                                                @endif
                                            </td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="{{ $billings->reference_no }}"
                                                            name="btn_link_hei_bank_cert"
                                                            class="btn_link_hei_bank_cert btn btn-outline-info"
                                                            data-bs-toggle="modal" data-bs-tooltip=""
                                                            data-placement="bottom" type="button"
                                                            title="Attach link for hei bank certification"
                                                            data-bs-target="#mod_upload_link_hei_bank_certification"><i
                                                                class="fas fa-paperclip"></i></button>
                                                        <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billings->hei_bank_cert_link }}" target="_blank"><i
                                                                class="far fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">7</td>
                                                <td class="text-left">Bank Certification of the HEI Certified by the
                                                    Bank
                                                </td>
                                                <td class="text-left"> <a href="{{ $billings->bank_cert_link }}"
                                                    target="_blank">{{ $billings->bank_cert_link }}</a></td>
                                            <td class="text-center">
                                                @if ($billings->bank_cert_status == 0)
                                                    <span class="badge badge-pill badge-secondary input-style">No
                                                        Attachment</span>
                                                @elseif ($billings->bank_cert_status == 1)
                                                    <span class="badge badge-pill badge-warning input-style">For
                                                        Review</span>
                                                @elseif ($billings->bank_cert_status == 2)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->bank_cert_status == 3)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by UniFAST Billing Unit</span>
                                                @elseif ($billings->bank_cert_status == 4)
                                                    <span
                                                        class="badge badge-pill badge-success input-style">Approved
                                                        by CHED-AFMS</span>
                                                @elseif ($billings->bank_cert_status == 5)
                                                    <span class="badge badge-pill badge-danger input-style">Rejected
                                                        by CHED-AFMS</span>
                                                @endif
                                            </td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button id="{{ $billings->reference_no }}"
                                                            name="btn_link_bank_cert"
                                                            class="btn_link_bank_cert btn btn-outline-info"
                                                            data-bs-toggle="modal" data-bs-tooltip=""
                                                            data-placement="bottom" type="button"
                                                            title="Attach link for bank certification"
                                                            data-bs-target="#mod_upload_link_bank_certification"><i
                                                                class="fas fa-paperclip"></i></button>
                                                        <a class="btn btn-outline-info" role="button" data-bs-tooltip=""
                                                            data-placement="bottom" title="View billing submission"
                                                            href="{{ $billings->bank_cert_link }}" target="_blank"><i
                                                                class="far fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr></tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 offset-xl-0">
                                        <div class="form-group input-style"><label>Remarks</label>
                                            <textarea class="form-control form-control-lg input-style" placeholder="Type your remarks here. . ."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 offset-xl-0">
                                        <div class="form-group input-style">
                                            <p class="text-right"><button class="btn btn-outline-primary btn-sm"
                                                    type="button" data-toggle="modal"
                                                    data-target="#mod_submit_final_billing"><i
                                                        class="far fa-paper-plane"></i>&nbsp;Submit Final
                                                    Billing</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

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

@include('modals.attachlinks')

{{-- <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js')}}"></script> --}}
<script src="{{ url('js\studsettings.js') }}"></script>
<script type="text/javascript" src="{{ url('js\jquery.min.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}">
</script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.3.0/js/dataTables.rowGroup.min.js"></script>
<script type="text/javascript" src="{{ url('js\chart.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js\bs-init.js') }}"></script>
<script type="text/javascript" src="{{ url('js\bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js\theme.js') }}"></script>
<script type="text/javascript" src="{{ url('js\showandhide.js') }}"></script>
<script type="text/javascript" src="{{ url('js\summary.js') }}"></script>
<script type="text/javascript" src="{{ url('js\attachments.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('https://unpkg.com/xlsx/dist/xlsx.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js">
</script>

</body>

</html>
