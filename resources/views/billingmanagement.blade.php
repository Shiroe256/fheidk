<?php $f = new NumberFormatter('en', NumberFormatter::ORDINAL); ?>
@include('includes.header')
<div class="container-fluid">
    <h6 class="text-dark mb-4">FHE Management / AY
        {{ $ac_year }}&nbsp;/&nbsp;{{ $f->format($semester) }}
        Semester / {{ $f->format($tranche) }} Tranche / Reference No. {{ $reference_no }}</h6>
    <input type="hidden" name="ac_year" id="ac_year" value="{{ $ac_year }}">
    <input type="hidden" name="semester" id="semester" value="{{ $semester }}">
    <input type="hidden" name="tranche" id="tranche" value="{{ $tranche }}">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center"><a
                class="btn btn-outline-dark btn-sm" role="button" href="{{ route('billings') }}"><i
                    class="fas fa-arrow-left"></i>&nbsp;Return to the
                previous page</a>
            @if ($billing_status != 2 || $billing_status >= 5)
                <div class="btn-group" role="group">
                    <input type="hidden" id="reference_no" name="reference_no" value="{{ $reference_no }}">
                    <input type="hidden" id="billing_status" name="billing_status" value="{{ $billing_status }}">
                    <a href="{{ Request::url() }}{{ '/settings' }}" id="btn_settings"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-sliders"></i>&nbsp;Manage
                        Settings</a>
                    <button id="btn_download_template" class="btn btn-outline-primary btn-sm"><i
                            class="fas fa-download"></i>&nbsp;Download Template</button>
                    <button id="btn_upload" class="btn btn-outline-primary btn-sm" type="button"><i
                            class="fas fa-file-upload"></i>&nbsp;Upload
                        List</button>
                    <button id="btn_queue" class="btn btn-outline-primary btn-sm" type="button"><i
                            class="far fa-edit"></i>&nbsp;Run Validation</button>
                    <button id="btn_exceptions" class="btn btn-outline-danger btn-sm" type="button"
                        style="display:none"><i class="fas fa-exclamation-triangle"></i>&nbsp;Exception
                        Report</button>
                    <button id="btn_forms" class="btn btn-outline-primary btn-sm" type="button" style="display:none"><i
                            class="far fa-file-alt"></i>&nbsp;Billing Forms</button>
                     {{-- <button id="btn_finalize" class="btn btn-outline-primary btn-sm" type="button"
                        value="{{ $reference_no }}"><i class="far fa-file-alt"></i>&nbsp;Submit for Review</button> --}}
                    <button id="btn_finalize" class="btn btn-outline-primary btn-sm" type="button"
                        value="{{ $reference_no }}"><i class="far fa-file-alt"></i>&nbsp;Finalize</button>
                </div>
            @endif
        </div>

        @if ($billing_status == 1 || $billing_status =3)
            <div id="billing_forms_div" class="card-body billing_forms_div">
            @else
                <div id="billing_forms_div" class="card-body billing_forms_div" style="display:none">
        @endif
        <div>
            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item"><a class="nav-link active input-style-tabs" role="tab" data-toggle="tab"
                        href="#tab-4">BILLING FORM 1</a></li>
                <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab"
                        href="#tab-5">BILLING FORM 2</a></li>
                <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab"
                        href="#tab-6">BILLING FORM 3</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" role="tabpanel" id="tab-4">
                    <form class="mt-4">
                        <div class="form-group input-style">
                            <h5 class="text-black-50 mb-4"><i class="fas fa-list-ul"></i>&nbsp;Summary
                            </h5>
                            <div id="summary_placeholder">
                                <div class="row">
                                    <div class="col">
                                        <p class="skeleton skeleton-text"></p>
                                    </div>
                                    <div class="col"></div>
                                    <div class="col"></div>
                                </div>
                                <div class="row py-3">
                                    <div class="col">
                                        <p class="skeleton skeleton-text"></p>
                                        <p class="skeleton skeleton-text"></p>
                                        <p class="skeleton skeleton-text"></p>
                                    </div>
                                    <div class="col">
                                        <p class="skeleton skeleton-text"></p>
                                        <p class="skeleton skeleton-text"></p>
                                        <p class="skeleton skeleton-text"></p>
                                    </div>
                                    <div class="col">
                                        <p class="skeleton skeleton-text"></p>
                                        <p class="skeleton skeleton-text"></p>
                                        <p class="skeleton skeleton-text"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="skeleton skeleton-text skeleton-body"></p>
                                    </div>
                                </div>
                            </div>
                            <div id="show_summary" class="table-responsive table-style mt-2 show_summary"
                                role="grid" aria-describedby="dataTable_info">
                                {{-- SUMMARY TABLE HERE --}}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="tab-5">
                    <form class="mt-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-lg-3 col-xl-4">
                                    <h5 class="text-black-50 mb-4"><i
                                            class="fas fa-user-graduate"></i>&nbsp;Beneficiaries</h5>
                                </div>
                                <div class="col text-right">
                                    <div class="btn-group" role="group"><button
                                            class="btn btn-outline-primary btn-sm" type="button"
                                            data-bs-toggle="modal" data-bs-target="#mod_new_student_info"><i
                                                class="fas fa-user-plus"></i>&nbsp;Add
                                            Student</button><button class="btn btn-outline-danger btn-sm d-none"
                                            id="btn_delete_students" type="button"></button>
                                        <button class="btn btn-outline-primary btn-sm d-none" id="btn_edit_students"
                                            type="button">Edit
                                            Students</button>
                                    </div>
                                </div>
                            </div>
                            <div id="students-placeholder" class="p-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td colspan="5">
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                            <td>
                                                <div class="skeleton skeleton-text skeleton-body"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="show_all_students" class="table-responsive mt-2 table-style d-none"
                                role="grid" aria-describedby="dataTable_info">
                                <table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
                                    id="tbl_students">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" name="main_checkbox"></th>
                                            <th class="text-left">HEI CAMPUS</th>
                                            <th class="text-left">APP ID</th>
                                            <th class="text-left">AWARD NUMBER</th>
                                            <th class="text-left">LASTNAME</th>
                                            <th class="text-left">FIRSTNAME</th>
                                            <th class="text-left">MIDDLENAME</th>
                                            <th>COURSE</th>
                                            <th class="text-center">YEAR</th>
                                            <th class="text-left">REMARKS</th>
                                            <th class="text-left">STATUS</th>
                                            <th class="text-left"
                                                title="No need to click this after saving. This is just for viewing purposes"
                                                data-placement="bottom">AMOUNT BILLED <i
                                                    class="fa-solid fa-circle-question"></i></th>
                                            <th class="text-center">ACTIONS</th>
                                        </tr>
                                    </thead>
                                </table>
                                {{-- STUDENT TABLE HERE --}}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="tab-6">
                    <form class="mt-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-lg-3 col-xl-4">
                                    <h5 class="text-black-50 mb-4"><i
                                            class="fas fa-pencil-ruler"></i>&nbsp;Entrance/Admission
                                        Exam</h5>
                                </div>
                                <div class="col text-right">
                                    <div class="btn-group" role="group"><button
                                            class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal"
                                            data-target="#mod_admission_entrance"><i
                                                class="fas fa-user-plus"></i>&nbsp;Add
                                            Applicant</button><button
                                            class="btn btn_delete_student btn-outline-danger btn-sm" type="button"><i
                                                class="fas fa-user-minus"></i>&nbsp;Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div id="show_all_applicants" class="table-responsive mt-2 table-style" role="grid"
                                aria-describedby="dataTable_info">
                                {{-- APPLICANTS TABLE HERE --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @if ($billing_status == 4)
        <div id="billing_exceptions_div" class="card-body billing_exceptions_div">
        @else
            <div id="billing_exceptions_div" class="card-body billing_exceptions_div" style="display:none">
    @endif
    <form>
        <div class="form-group input-style">
            <div class="form-row">
                <div class="col-lg-3 col-xl-4">
                    <h5 class="text-danger mb-4"><i class="fa fa-warning"></i>&nbsp;Exception Report
                    </h5>
                </div>
                <div class="col text-right">
                    <div class="btn-group" role="group"><button class="btn btn-outline-danger btn-sm"
                            type="button" data-toggle="modal" data-target="#mod_remove"><i
                                class="fas fa-user-minus"></i>&nbsp;Remove</button></div>
                </div>
            </div>
            <div id="show_all_exceptions" class="table-responsive mt-2 table-style" role="grid"
                aria-describedby="dataTable_info">
                {{-- EXCEPTIONS TABLE HERE --}}
            </div>
        </div>
    </form>
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

@include('modals.addstudent')
@include('modals.editstudent')
@include('modals.admissionentrance')
@include('modals.nstpinfo')
@include('modals.errors')
@include('modals.upload')
@include('modals.studentsettings')
@include('modals.studentfees')

<div class="modal fade" role="dialog" tabindex="-1" id="mod_remove">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">Remove Student Confirmation</h6><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"><label>Are you sure you want to remove this student from the list?</label>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button"
                        data-dismiss="modal">Close</button><button class="btn btn-danger card-button-style"
                        type="button">Confirm</button></div>
            </form>
        </div>
    </div>
</div>

{{-- <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js')}}"></script> --}}
{{-- <script src="{{ url('js\studsettings.js') }}"></script> --}}
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
<script type="text/javascript" src="{{ url('js\student_crud.js') }}"></script>
<script type="text/javascript" src="{{ url('js\summary.js') }}"></script>
<script type="text/javascript" src="{{ url('js\exception_report.js') }}"></script>
<script type="text/javascript" src="{{ url('js\applicant_crud.js') }}"></script>
<script type="text/javascript" src="{{ url('js\dateformat.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('https://unpkg.com/xlsx/dist/xlsx.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js">
</script>

</body>

</html>
