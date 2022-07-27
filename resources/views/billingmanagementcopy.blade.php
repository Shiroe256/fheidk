@include('includes.header');
<div class="container-fluid">
    <h5 class="text-dark mb-4">FHE Management / <span class="badge badge-pill badge-info">AY
            2020-2021</span>&nbsp;/&nbsp;<span class="badge badge-pill badge-info">1st Semester</span> / <span
            class="badge badge-pill badge-info">1st Tranche</span></h5>
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center"><a class="btn btn-outline-dark btn-sm"
                role="button" href="{{ route('listofbillings') }}"><i class="fas fa-arrow-left"></i>&nbsp;Return to the
                previous page</a>
            <div class="btn-group" role="group">
                <button id="btn_run_billing_checker" class="btn btn-outline-info btn-sm" type="button"
                    data-toggle="modal" data-target="#mod_billing_checker"><i class="far fa-edit"></i>&nbsp;Run Billing
                    Checker</button>
                <button id="btn_forms" class="btn btn-outline-info btn-sm" type="button" style="display:none"><i
                        class="far fa-file-alt"></i>&nbsp;Billing Forms</button>
            </div>
        </div>
        <div id="billing_forms_div" class="card-body billing_forms_div">
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
                                <h5 class="text-black-50 mb-4"><i class="fas fa-list-ul"></i>&nbsp;Summary</h5>
                                <div class="table-responsive table-style mt-2" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
                                        id="tbl_billingform_1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NO.</th>
                                                <th class="text-center">HEI CAMPUS</th>
                                                <th class="text-center">TOTAL BENEFICIARIES<br></th>
                                                <th class="text-center">TOTAL AMOUNT<br></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-center">Diliman (Main)</td>
                                                <td class="text-center">123,456</td>
                                                <td class="text-center">123,456,789.50</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-center">Los Baños</td>
                                                <td class="text-center">123,456<br></td>
                                                <td class="text-center">123,456,789.50<br></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-center">Visayas</td>
                                                <td class="text-center">123,456<br></td>
                                                <td class="text-center">123,456,789.50<br></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr></tr>
                                        </tfoot>
                                    </table>
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
                                                class="btn btn-outline-info btn-sm" type="button" data-toggle="modal"
                                                data-target="#mod_upload"><i class="fas fa-file-upload"></i>&nbsp;Upload
                                                List</button><button class="btn btn-outline-info btn-sm" type="button"
                                                data-toggle="modal" data-target="#mod_new_student_info"><i
                                                    class="fas fa-user-plus"></i>&nbsp;Add Student</button><button
                                                class="btn btn-outline-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#mod_remove"><i
                                                    class="fas fa-user-minus"></i>&nbsp;Remove</button></div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-2 table-style" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
                                        id="tbl_billingform_2">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><input type="checkbox"></th>
                                                <th class="text-left">HEI CAMPUS</th>
                                                <th class="text-left">AWARD NUMBER</th>
                                                <th class="text-left">LASTNAME</th>
                                                <th class="text-left">FIRSTNAME</th>
                                                <th class="text-left">MIDDLENAME</th>
                                                <th>COURSE</th>
                                                <th class="text-center">YEAR</th>
                                                <th class="text-left">REMARKS</th>
                                                <th class="text-left">STATUS</th>
                                                <th class="text-center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><input type="checkbox"></td>
                                                <td class="text-left">Diliman (Main)</td>
                                                <td class="text-left">FHE-123-456</td>
                                                <td>Molina</td>
                                                <td>Carlo</td>
                                                <td>Espartinez</td>
                                                <td>Bachelor of Science in Information and Techology</td>
                                                <td class="text-center">4</td>
                                                <td class="text-left">Graduating</td>
                                                <td class="text-left">Duplicate Entry<br></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group"><button
                                                            class="btn btn-outline-info" data-toggle="modal"
                                                            data-bs-tooltip="" data-placement="bottom" type="button"
                                                            title="Edit Student Information"
                                                            data-target="#mod_new_student_info"><i
                                                                class="far fa-edit"></i></button></div>
                                                </td>
                                            </tr>

                                        </tbody>
                                        <tfoot>
                                            <tr></tr>
                                        </tfoot>
                                    </table>
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
                                                class="fas fa-pencil-ruler"></i>&nbsp;Entrance/Admission Exam</h5>
                                    </div>
                                    <div class="col text-right">
                                        <div class="btn-group" role="group"><button
                                                class="btn btn-outline-info btn-sm" type="button"
                                                data-toggle="modal" data-target="#mod_upload"><i
                                                    class="fas fa-file-upload"></i>&nbsp;Upload List</button><button
                                                class="btn btn-outline-info btn-sm" type="button"
                                                data-toggle="modal" data-target="#mod_admission_entrance"><i
                                                    class="fas fa-user-plus"></i>&nbsp;Add Applicant</button><button
                                                class="btn btn-outline-danger btn-sm" type="button"
                                                data-toggle="modal" data-target="#mod_remove"><i
                                                    class="fas fa-user-minus"></i>&nbsp;Remove</button></div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-2 table-style" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
                                        id="tbl_billingform_3">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><input type="checkbox"></th>
                                                <th class="text-left">HEI CAMPUS</th>
                                                <th class="text-left">AWARD NUMBER</th>
                                                <th class="text-left">LASTNAME</th>
                                                <th class="text-left">FIRSTNAME</th>
                                                <th class="text-left">MIDDLENAME</th>
                                                <th>COURSE</th>
                                                <th class="text-center">YEAR</th>
                                                <th class="text-left">REMARKS</th>
                                                <th class="text-center">NO. OF EXAM TAKEN</th>
                                                <th class="text-left">STATUS</th>
                                                <th class="text-center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><input type="checkbox"></td>
                                                <td class="text-left">DIliman (Main)</td>
                                                <td class="text-left">FHE-123-456</td>
                                                <td>Molina</td>
                                                <td>Carlo</td>
                                                <td>Espartinez</td>
                                                <td>Bachelor of Science in Information and Techology</td>
                                                <td class="text-center">4</td>
                                                <td class="text-left">Transferee</td>
                                                <td class="text-center">1</td>
                                                <td class="text-left">Passed and Enrolled<br></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group"><button
                                                            class="btn btn-outline-info" data-toggle="modal"
                                                            data-bs-tooltip="" data-placement="bottom" type="button"
                                                            title="Edit Student Information"
                                                            data-target="#mod_admission_entrance"><i
                                                                class="far fa-edit"></i></button></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><input type="checkbox"></td>
                                                <td class="text-left">Los Baños</td>
                                                <td class="text-left">FHE-123-456</td>
                                                <td>Molina</td>
                                                <td>Carlo</td>
                                                <td>Espartinez</td>
                                                <td>Bachelor of Science in Information and Techology</td>
                                                <td class="text-center">1</td>
                                                <td class="text-left"><br></td>
                                                <td class="text-center">1</td>
                                                <td class="text-left">Passed but did not Enroll<br></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group"><button
                                                            class="btn btn-outline-info" data-toggle="modal"
                                                            data-bs-tooltip="" data-placement="bottom" type="button"
                                                            title="Edit Student Information"
                                                            data-target="#mod_admission_entrance"><i
                                                                class="far fa-edit"></i></button></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><input type="checkbox"></td>
                                                <td class="text-left">Visayas</td>
                                                <td class="text-left">FHE-123-456</td>
                                                <td>Molina</td>
                                                <td>Carlo</td>
                                                <td>Espartinez</td>
                                                <td>Bachelor of Science in Information and Techology</td>
                                                <td class="text-center">1</td>
                                                <td class="text-left"><br></td>
                                                <td class="text-center">2</td>
                                                <td class="text-left">Failed<br></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group"><button
                                                            class="btn btn-outline-info" data-toggle="modal"
                                                            data-bs-tooltip="" data-placement="bottom" type="button"
                                                            title="Edit Student Information"
                                                            data-target="#mod_admission_entrance"><i
                                                                class="far fa-edit"></i></button></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><input type="checkbox"></td>
                                                <td class="text-left">Baguio</td>
                                                <td class="text-left">FHE-123-456</td>
                                                <td>Molina</td>
                                                <td>Carlo</td>
                                                <td>Espartinez</td>
                                                <td>Bachelor of Science in Information and Techology</td>
                                                <td class="text-center">1</td>
                                                <td class="text-left"></td>
                                                <td class="text-center">1</td>
                                                <td class="text-left">Passed and Enrolled<br></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group"><button
                                                            class="btn btn-outline-info" data-toggle="modal"
                                                            data-bs-tooltip="" data-placement="bottom" type="button"
                                                            title="Edit Student Information"
                                                            data-target="#mod_admission_entrance"><i
                                                                class="far fa-edit"></i></button></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><input type="checkbox"></td>
                                                <td class="text-left">Baguio</td>
                                                <td class="text-left">FHE-123-456</td>
                                                <td>Molina</td>
                                                <td>Carlo</td>
                                                <td>Espartinez</td>
                                                <td>Bachelor of Science in Information and Techology</td>
                                                <td class="text-center">1</td>
                                                <td class="text-left"></td>
                                                <td class="text-center">2</td>
                                                <td class="text-left">Passed and Enrolled<br></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group"><button
                                                            class="btn btn-outline-info" data-toggle="modal"
                                                            data-bs-tooltip="" data-placement="bottom" type="button"
                                                            title="Edit Student Information"
                                                            data-target="#mod_admission_entrance"><i
                                                                class="far fa-edit"></i></button></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><input type="checkbox"></td>
                                                <td class="text-left">Baguio</td>
                                                <td class="text-left">FHE-123-456</td>
                                                <td>Molina</td>
                                                <td>Carlo</td>
                                                <td>Espartinez</td>
                                                <td>Bachelor of Science in Information and Techology</td>
                                                <td class="text-center">1</td>
                                                <td class="text-left"></td>
                                                <td class="text-center">1</td>
                                                <td class="text-left">Passed but did not Enroll<br></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group"><button
                                                            class="btn btn-outline-info" data-toggle="modal"
                                                            data-bs-tooltip="" data-placement="bottom" type="button"
                                                            title="Edit Student Information"
                                                            data-target="#mod_admission_entrance"><i
                                                                class="far fa-edit"></i></button></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="billing_exceptions_div" class="card-body billing_exceptions_div" style="display:none">
            <form>
                <div class="form-group input-style">
                    <div class="form-row">
                        <div class="col-lg-3 col-xl-4">
                            <h5 class="text-danger mb-4"><i class="fa fa-warning"></i>&nbsp;Exception Report</h5>
                        </div>
                        <div class="col text-right">
                            <div class="btn-group" role="group"><button class="btn btn-outline-danger btn-sm"
                                    type="button" data-toggle="modal" data-target="#mod_remove"><i
                                        class="fas fa-user-minus"></i>&nbsp;Remove</button></div>
                        </div>
                    </div>
                    <div class="table-responsive mt-2 table-style" role="grid" aria-describedby="dataTable_info">
                        <table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
                            id="tbl_exception_report">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox"></th>
                                    <th class="text-left">HEI CAMPUS</th>
                                    <th class="text-left">AWARD NUMBER</th>
                                    <th class="text-left">LASTNAME</th>
                                    <th class="text-left">FIRSTNAME</th>
                                    <th class="text-left">MIDDLENAME</th>
                                    <th>COURSE</th>
                                    <th class="text-center">YEAR</th>
                                    <th class="text-left">REMARKS</th>
                                    <th class="text-left">STATUS</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><input type="checkbox"></td>
                                    <td class="text-left">DIliman (Main)</td>
                                    <td class="text-left">FHE-123-456</td>
                                    <td>Molina</td>
                                    <td>Carlo</td>
                                    <td>Espartinez</td>
                                    <td>Bachelor of Science in Information and Techology</td>
                                    <td class="text-center">4</td>
                                    <td class="text-left">Graduating</td>
                                    <td class="text-left">Duplicate Entry<br></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group"><button
                                                class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip=""
                                                data-placement="bottom" type="button"
                                                title="Edit Student Information"
                                                data-target="#mod_new_student_info"><i
                                                    class="far fa-edit"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox"></td>
                                    <td class="text-left">Los Baños</td>
                                    <td class="text-left">FHE-123-456</td>
                                    <td>Molina</td>
                                    <td>Carlo</td>
                                    <td>Espartinez</td>
                                    <td>Bachelor of Science in Information and Techology</td>
                                    <td class="text-center">1</td>
                                    <td class="text-left"><br></td>
                                    <td class="text-left">Duplicate Entry<br></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group"><button
                                                class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip=""
                                                data-placement="bottom" type="button"
                                                title="Edit Student Information"
                                                data-target="#mod_new_student_info"><i
                                                    class="far fa-edit"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox"></td>
                                    <td class="text-left">Visayas</td>
                                    <td class="text-left">FHE-123-456</td>
                                    <td>Molina</td>
                                    <td>Carlo</td>
                                    <td>Espartinez</td>
                                    <td>Bachelor of Science in Information and Techology</td>
                                    <td class="text-center">3</td>
                                    <td class="text-left"><br></td>
                                    <td class="text-left">Maximum Amount for Guidance Fee / Laboratory Fee/ Development
                                        Fee Exceeded<br></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group"><button
                                                class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip=""
                                                data-placement="bottom" type="button"
                                                title="Edit Student Information"
                                                data-target="#mod_new_student_info"><i
                                                    class="far fa-edit"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox"></td>
                                    <td class="text-left">Baguio</td>
                                    <td class="text-left">FHE-123-456</td>
                                    <td>Molina</td>
                                    <td>Carlo</td>
                                    <td>Espartinez</td>
                                    <td>Bachelor of Science in Information and Techology</td>
                                    <td class="text-center">4</td>
                                    <td class="text-left">Graduating</td>
                                    <td class="text-left">Exceeded the Maximum Grace Period Allowed<br></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group"><button
                                                class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip=""
                                                data-placement="bottom" type="button"
                                                title="Edit Student Information"
                                                data-target="#mod_new_student_info"><i
                                                    class="far fa-edit"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox"></td>
                                    <td class="text-left">Baguio</td>
                                    <td class="text-left">FHE-123-456</td>
                                    <td>Molina</td>
                                    <td>Carlo</td>
                                    <td>Espartinez</td>
                                    <td>Bachelor of Science in Information and Techology</td>
                                    <td class="text-center">4</td>
                                    <td class="text-left">Graduating</td>
                                    <td class="text-left">NSTP taken exceeded 6 units</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group"><button
                                                class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip=""
                                                data-placement="bottom" type="button"
                                                title="Edit Student Information" data-target="#mod_nstp_info"><i
                                                    class="far fa-edit"></i></button></div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <div id="summary_billing_div" class="card-body summary_billing_div" style="display:none">
            <div>
                <ul class="nav nav-tabs nav-fill">
                    <li class="nav-item"><a class="nav-link active input-style-tabs" role="tab"
                            data-toggle="tab" href="#tab-7">GENERATE BILLING FORMS</a></li>
                    <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab"
                            href="#tab-8">SUBMIT FINAL BILLING</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" role="tabpanel" id="tab-7">
                        <form class="mt-4">
                            <div class="form-group input-style">
                                <div class="form-row">
                                    <div class="col-lg-3 col-xl-4">
                                        <h5 class="text-black-50 mb-4"><i class="fas fa-suitcase"></i>&nbsp;Billing
                                            Summary</h5>
                                    </div>
                                    <div class="col text-right">
                                        <div class="btn-group" role="group"><button
                                                class="btn btn-outline-info btn-sm" type="button"><i
                                                    class="fas fa-file-download"></i>&nbsp;Download Generated
                                                Forms</button></div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-2 table-style" role="grid"
                                    aria-describedby="dataTable_info">
                                    <table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
                                        id="tbl_billing_summary">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NO.</th>
                                                <th class="text-center">HEI CAMPUS</th>
                                                <th class="text-center">TOTAL BENEFICIARIES<br></th>
                                                <th class="text-center">TOTAL AMOUNT<br></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-center">DIliman (Main)</td>
                                                <td class="text-center">123,456</td>
                                                <td class="text-center">123,456,789.50</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-center">Los Baños</td>
                                                <td class="text-center">123,456<br></td>
                                                <td class="text-center">123,456,789.50<br></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-center">Visayas</td>
                                                <td class="text-center">123,456<br></td>
                                                <td class="text-center">123,456,789.50<br></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="tab-8">
                        <form class="mt-4">
                            <h5 class="text-black-50 mb-4"><i class="fas fa-paper-plane"></i>&nbsp;Submit Billing</h5>
                            <div class="form-row">
                                <div class="col-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-label-small-size">Reference
                                                    Number</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span
                                                    class="span-billing-small-size">FHE-UP-2019-2020-1-1</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 offset-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-label-small-size">Date of
                                                    Submission</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-small-size">June 20,
                                                    2020</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-label-small-size">Academic
                                                    Year</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-small-size">2019-2020</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span
                                                    class="span-billing-label-small-size">Semester</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-small-size">1st</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span
                                                    class="span-billing-label-small-size">Tranche</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-small-size">1st</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-label-small-size">Total No.
                                                    of Beneficiaries</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span
                                                    class="text-danger span-billing-size">123,456,789</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-label-small-size">Total
                                                    Amount</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span
                                                    class="text-danger span-billing-size">123,456,789</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mt-2 table-style" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table table-bordered table-hover dataTable my-0 table-style"
                                    id="tbl_billing_attachments">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NO.</th>
                                            <th class="text-left">BILLING DOCUMENTS</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center">REMARKS</th>
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-left">Consolidated Billing Statement (Form 1)</td>
                                            <td class="text-center"><span
                                                    class="badge badge-pill badge-warning input-style">For
                                                    Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group"><a
                                                        class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_upload_signed_forms"><i
                                                            class="fas fa-file-upload"></i></a>
                                                    <a class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_view_uploaded_file"><i
                                                            class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="text-left">Consolidated Billing Details (Form 2)</td>
                                            <td class="text-center"><span
                                                    class="badge badge-pill badge-warning input-style">For
                                                    Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group"><a
                                                        class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_upload_signed_forms"><i
                                                            class="fas fa-file-upload"></i></a>
                                                    <a class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_view_uploaded_file"><i
                                                            class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="text-left">Consolidated Billing Details (Form 3)</td>
                                            <td class="text-center"><span
                                                    class="badge badge-pill badge-warning input-style">For
                                                    Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group"><a
                                                        class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_upload_signed_forms"><i
                                                            class="fas fa-file-upload"></i></a>
                                                    <a class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_view_uploaded_file"><i
                                                            class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td class="text-left">Notarized Registrar's Certification</td>
                                            <td class="text-center"><span
                                                    class="badge badge-pill badge-warning input-style">For
                                                    Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group"><a
                                                        class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_upload_signed_forms"><i
                                                            class="fas fa-file-upload"></i></a>
                                                    <a class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_view_uploaded_file"><i
                                                            class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td class="text-left">Certificate of Registration of Students (CORs)</td>
                                            <td class="text-center"><span
                                                    class="badge badge-pill badge-warning input-style">For
                                                    Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group"><a
                                                        class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_upload_link_cor"><i
                                                            class="fas fa-file-upload"></i></a>
                                                    <a class="btn btn-outline-info" role="button"
                                                        data-toggle="tooltip" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="https://unifast.gov.ph/assets/pdf/guidelines/UniFAST_MC012022.pdf"
                                                        target="_blank"><i class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td class="text-left">Bank Certification of the HEI Certified by the HEI
                                            </td>
                                            <td class="text-center"><span
                                                    class="badge badge-pill badge-warning input-style">For
                                                    Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group"><a
                                                        class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_upload_signed_forms"><i
                                                            class="fas fa-file-upload"></i></a>
                                                    <a class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_view_uploaded_file"><i
                                                            class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td class="text-left">Bank Certification of the HEI Certified by the Bank
                                            </td>
                                            <td class="text-center"><span
                                                    class="badge badge-pill badge-warning input-style">For
                                                    Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group"><a
                                                        class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_upload_signed_forms"><i
                                                            class="fas fa-file-upload"></i></a>
                                                    <a class="btn btn-outline-info" role="button"
                                                        data-toggle="modal" data-bs-tooltip=""
                                                        data-placement="bottom" title="View billing submission"
                                                        href="Admin/billinginformation.html"
                                                        data-target="#mod_view_uploaded_file"><i
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
                                        <p class="text-right"><button class="btn btn-outline-info btn-sm"
                                                type="button" data-toggle="modal"
                                                data-target="#mod_submit_final_billing"><i
                                                    class="far fa-paper-plane"></i>&nbsp;Submit Final Billing</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="summary_billing_submitted_div" class="card-body summary_billing_submitted_div" style="display:none">
            <form class="mt-4">
                <h5 class="text-black-50 mb-4"><i class="fas fa-paper-plane"></i> Submit Billing</h5>
                <div class="form-row">
                    <div class="col-xl-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col"><span class="span-billing-label-small-size">Reference
                                        Number</span></div>
                            </div>
                            <div class="form-row">
                                <div class="col"><span class="span-billing-small-size">FHE-UP-2019-2020-1-1</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 offset-xl-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col"><span class="span-billing-label-small-size">Date of
                                        Submission</span></div>
                            </div>
                            <div class="form-row">
                                <div class="col"><span class="span-billing-small-size">June 20, 2020</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xl-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col"><span class="span-billing-label-small-size">Academic Year</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"><span class="span-billing-small-size">2019-2020</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col"><span class="span-billing-label-small-size">Semester</span></div>
                            </div>
                            <div class="form-row">
                                <div class="col"><span class="span-billing-small-size">1st</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col"><span class="span-billing-label-small-size">Tranche</span></div>
                            </div>
                            <div class="form-row">
                                <div class="col"><span class="span-billing-small-size">1st</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xl-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col"><span class="span-billing-label-small-size">Total No. of
                                        Beneficiaries</span></div>
                            </div>
                            <div class="form-row">
                                <div class="col"><span class="text-danger span-billing-size">123,456,789</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col"><span class="span-billing-label-small-size">Total Amount</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col"><span class="text-danger span-billing-size">123,456,789</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-bordered table mt-2 table-style" role="grid"
                    aria-describedby="dataTable_info">
                    <table class="table table-bordered table-hover dataTable my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th class="text-center">NO.</th>
                                <th class="text-left">BILLING DOCUMENTS</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">REMARKS</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-left">Consolidated Billing Statement (Form 1)</td>
                                <td class="text-center"><span class="badge badge-pill badge-warning input-style">For
                                        Review</span></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <div role="group" class="btn-group btn-group-sm"><a
                                            class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_upload_signed_forms"><i
                                                class="fas fa-file-upload"></i></a>
                                        <a class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-left">Consolidated Billing Details (Form 2)</td>
                                <td class="text-center"><span class="badge badge-pill badge-warning input-style">For
                                        Review</span></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <div role="group" class="btn-group btn-group-sm"><a
                                            class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_upload_signed_forms"><i
                                                class="fas fa-file-upload"></i></a>
                                        <a class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td class="text-left">Consolidated Billing Details (Form 3)</td>
                                <td class="text-center"><span class="badge badge-pill badge-warning input-style">For
                                        Review</span></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <div role="group" class="btn-group btn-group-sm"><a
                                            class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_upload_signed_forms"><i
                                                class="fas fa-file-upload"></i></a>
                                        <a class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td class="text-left">Notarized Registrar&#39;s Certification</td>
                                <td class="text-center"><span class="badge badge-pill badge-warning input-style">For
                                        Review</span></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <div role="group" class="btn-group btn-group-sm"><a
                                            class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_upload_signed_forms"><i
                                                class="fas fa-file-upload"></i></a>
                                        <a class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td class="text-left">Certificate of Registration of Students (CORs)</td>
                                <td class="text-center"><span class="badge badge-pill badge-warning input-style">For
                                        Review</span></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <div role="group" class="btn-group btn-group-sm"><a
                                            class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html" data-target="#mod_upload_link_cor"><i
                                                class="fas fa-file-upload"></i></a>
                                        <a class="btn btn-outline-info" role="button" data-toggle="tooltip"
                                            data-placement="bottom" title="View billing submission"
                                            href="https://unifast.gov.ph/assets/pdf/guidelines/UniFAST_MC012022.pdf"
                                            target="_blank"><i class="far fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td class="text-left">Bank Certification of the HEI Certified by the HEI</td>
                                <td class="text-center"><span class="badge badge-pill badge-warning input-style">For
                                        Review</span></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <div role="group" class="btn-group btn-group-sm"><a
                                            class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_upload_signed_forms"><i
                                                class="fas fa-file-upload"></i></a>
                                        <a class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td class="text-left">Bank Certification of the HEI Certified by the Bank</td>
                                <td class="text-center"><span class="badge badge-pill badge-warning input-style">For
                                        Review</span></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <div role="group" class="btn-group btn-group-sm"><a
                                            class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_upload_signed_forms"><i
                                                class="fas fa-file-upload"></i></a>
                                        <a class="btn btn-outline-info" role="button" data-toggle="modal"
                                            data-placement="bottom" title="View billing submission"
                                            href="Admin/billinginformation.html"
                                            data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
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

@include('modals.addstudent');
@include('modals.admissionentrance');
@include('modals.nstpinfo');
@include('modals.upload');


<div class="modal fade" role="dialog" tabindex="-1" id="mod_view_uploaded_file">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">FHE-UP-2019-2020-1-1-FORM 1</h6><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col"><iframe
                                    src="https://unifast.gov.ph/assets/pdf/guidelines/UniFAST_MC022022.pdf"
                                    width="100%" height="500" style="overflow:hidden" scrolling="yes"
                                    frameborder="3" allowTransparency="true"></iframe></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="mod_upload_signed_forms">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">UPLOAD SIGNED BILLING FORMS</h6><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>File Name</label><input
                                        class="form-control input-style" type="text"
                                        value="FHE-UP-2019-2020-1-1-Form 1"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><input type="file" data-toggle="tooltip"
                                        data-bs-tooltip="" title="Select file to upload"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button"
                        data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style"
                        type="button">Upload</button></div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="mod_upload_link_cor">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">UPLOAD GDRIVE LINK</h6><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>URL Link</label><input
                                        class="form-control input-style" type="text"
                                        value="https://drive.google.com/drive/u/0/my-drive"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button"
                        data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style"
                        type="button">Upload</button></div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="mod_billing_checker">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">Run Billing Checker Confirmation</h6><button type="button"
                        class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"><label>Are you sure you want to run billing checker? This will take
                        sometime.</label></div>
                <div class="modal-footer"><button id="btn_no" class="btn btn-danger card-button-style"
                        type="button" data-dismiss="modal">Cancel</button><button id="btn_yes"
                        class="btn btn-primary card-button-style" type="button" data-dismiss="modal">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" tabindex="-1" id="mod_submit_final_billing">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">Submit Billing Confirmation</h6><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"><label>Are you sure you want to submit this final billing? This will disable
                        you from editing the forms.</label></div>
                <div class="modal-footer"><button class="btn btn-danger card-button-style" type="button"
                        data-dismiss="modal">Cancel</button><a class="btn btn-primary card-button-style"
                        role="button" href="listofbillings.html">Submit</a></div>
            </form>
        </div>
    </div>
</div>
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

<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js') }}"></script>
<script type="text/javascript" src="{{ url('js\bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js\jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js\chart.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js\bs-init.js') }}"></script>
<script type="text/javascript" src="{{ url('js\theme.js') }}"></script>
<script type="text/javascript" src="{{ url('js\xlsx.full.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js\showandhide.js') }}"></script>
<script type="text/javascript" src="{{ url('js\datatables.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}">
</script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js') }}"></script>
<script src="{{ url('https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    document.getElementById("btn_upload_template").onclick = function() {
        console.log("nag click");
        var template = document.getElementById("upload_template").files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.readFile(data);
            var range = workbook.Sheets.Billing_Form;

            var output = XLSX.utils.sheet_to_json(range, {
                header: [
                    "seq_no",
                    "fhe_aw_no",
                    "stud_no",
                    "lrnum",
                    "last_name",
                    "given_name",
                    "mid_name",
                    "ext_name",
                    "sex_at_birth",
                    "birthdate",
                    "birthplace",
                    "fathers_lname",
                    "fathers_gname",
                    "fathers_mname",
                    "mothers_lname",
                    "mothers_gname",
                    "mothers_mname",
                    "perm_prov",
                    "perm_city",
                    "perm_brgy",
                    "perm_street",
                    "perm_zip",
                    "pres_prov",
                    "pres_city",
                    "pres_brgy",
                    "pres_street",
                    "pres_zip",
                    "email",
                    "a_email",
                    "contact_number",
                    "contact_number_2",
                    "is_transferee",
                    "degree_course_id",
                    "year_level",
                    "lab_u",
                    "com_lab_u",
                    "acad_u",
                    "nstp_u",
                    "exams",
                    "exam_result",
                    "remarks"
                ]
            });
            console.log(JSON.stringify(output));

            // let request = new XMLHttpRequest();
            // request.open("POST", );
            // // request.setRequestHeader("Accept", "application/json");
            // request.setRequestHeader("X-Requested-With", 'XMLHttpRequest');
            // request.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
            // request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: window.location.origin + "/add-tempstudents",
                type: "POST",
                data: JSON.stringify(output),
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                }
            });


            request.send(output);

        };
        reader.readAsArrayBuffer(template);

    }
</script>
</body>

</html>
