@include('includes.header');
            <div class="container-fluid">
                <h5 class="text-dark mb-4">FHE Management / <span class="badge badge-pill badge-info">AY 2020-2021</span>&nbsp;/&nbsp;<span class="badge badge-pill badge-info">1st Semester</span> / <span class="badge badge-pill badge-info">1st Tranche</span></h5>
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center"><a class="btn btn-outline-dark btn-sm" role="button" href="{{route('listofbillings')}}"><i class="fas fa-arrow-left"></i>&nbsp;Return to the previous page</a>
                        <div class="btn-group" role="group">
                            <button id="btn_run_billing_checker" class="btn btn-outline-info btn-sm" type="button" data-toggle="modal" data-target="#mod_billing_checker"><i class="far fa-edit"></i>&nbsp;Run Billing Checker</button>
                            <button id="btn_forms" class="btn btn-outline-info btn-sm" type="button" style="display:none"><i class="far fa-file-alt"></i>&nbsp;Billing Forms</button>
                        </div>
                    </div>
                    <div id="billing_forms_div" class="card-body billing_forms_div">
                        <div>
                            <ul class="nav nav-tabs nav-fill">
                                <li class="nav-item"><a class="nav-link active input-style-tabs" role="tab" data-toggle="tab" href="#tab-4">BILLING FORM 1</a></li>
                                <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab" href="#tab-5">BILLING FORM 2</a></li>
                                <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab" href="#tab-6">BILLING FORM 3</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" role="tabpanel" id="tab-4">
                                    <form class="mt-4">
                                        <div class="form-group input-style">
                                            <h5 class="text-black-50 mb-4"><i class="fas fa-list-ul"></i>&nbsp;Summary</h5>
                                            <div class="table-responsive table-bordered table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
                                                <table class="table table-bordered table-hover table-sm dataTable my-0" id="dataTable">
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
                                <div class="tab-pane fade" role="tabpanel" id="tab-5">
                                    <form class="mt-4">
                                        <div class="form-group input-style">
                                            <div class="form-row">
                                                <div class="col-lg-3 col-xl-4">
                                                    <h5 class="text-black-50 mb-4"><i class="fas fa-user-graduate"></i>&nbsp;Beneficiaries</h5>
                                                </div>
                                                <div class="col text-right">
                                                    <div class="btn-group" role="group"><button class="btn btn-outline-info btn-sm" type="button" data-toggle="modal" data-target="#mod_upload"><i class="fas fa-file-upload"></i>&nbsp;Upload List</button><button class="btn btn-outline-info btn-sm"
                                                            type="button" data-toggle="modal" data-target="#mod_new_student_info"><i class="fas fa-user-plus"></i>&nbsp;Add Student</button><button class="btn btn-outline-danger btn-sm" type="button" data-toggle="modal"
                                                            data-target="#mod_remove"><i class="fas fa-user-minus"></i>&nbsp;Remove</button></div>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-bordered table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
                                                <table class="table table-bordered table-hover table-sm dataTable my-0" id="dataTable">
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                            <td class="text-left">Maximum Amount for Guidance Fee / Laboratory Fee/ Development Fee Exceeded<br></td>
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                            <td class="text-left">For Payment</td>
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                            <td class="text-left">For Payment<br></td>
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                    <h5 class="text-black-50 mb-4"><i class="fas fa-pencil-ruler"></i>&nbsp;Entrance/Admission Exam</h5>
                                                </div>
                                                <div class="col text-right">
                                                    <div class="btn-group" role="group"><button class="btn btn-outline-info btn-sm" type="button" data-toggle="modal" data-target="#mod_upload"><i class="fas fa-file-upload"></i>&nbsp;Upload List</button><button class="btn btn-outline-info btn-sm"
                                                            type="button" data-toggle="modal" data-target="#mod_admission_entrance"><i class="fas fa-user-plus"></i>&nbsp;Add Applicant</button><button class="btn btn-outline-danger btn-sm" type="button" data-toggle="modal"
                                                            data-target="#mod_remove"><i class="fas fa-user-minus"></i>&nbsp;Remove</button></div>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-bordered table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
                                                <table class="table table-bordered table-hover table-sm dataTable my-0" id="dataTable">
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_admission_entrance"><i class="far fa-edit"></i></button></div>
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_admission_entrance"><i class="far fa-edit"></i></button></div>
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_admission_entrance"><i class="far fa-edit"></i></button></div>
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_admission_entrance"><i class="far fa-edit"></i></button></div>
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_admission_entrance"><i class="far fa-edit"></i></button></div>
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
                                                                <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_admission_entrance"><i class="far fa-edit"></i></button></div>
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
                                        <div class="btn-group" role="group"><button class="btn btn-outline-danger btn-sm" type="button" data-toggle="modal" data-target="#mod_remove"><i class="fas fa-user-minus"></i>&nbsp;Remove</button></div>
                                    </div>
                                </div>
                                <div class="table-responsive table-bordered table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
                                    <table class="table table-bordered table-hover table-sm dataTable my-0" id="dataTable">
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
                                                    <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                    <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                <td class="text-left">Maximum Amount for Guidance Fee / Laboratory Fee/ Development Fee Exceeded<br></td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                    <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div>
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
                                                    <div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_nstp_info"><i class="far fa-edit"></i></button></div>
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
                                <li class="nav-item"><a class="nav-link active input-style-tabs" role="tab" data-toggle="tab" href="#tab-7">GENERATE BILLING FORMS</a></li>
                                <li class="nav-item"><a class="nav-link input-style-tabs" role="tab" data-toggle="tab" href="#tab-8">SUBMIT FINAL BILLING</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" role="tabpanel" id="tab-7">
                                    <form class="mt-4">
                                        <div class="form-group input-style">
                                            <div class="form-row">
                                                <div class="col-lg-3 col-xl-4">
                                                    <h5 class="text-black-50 mb-4"><i class="fas fa-suitcase"></i>&nbsp;Billing Summary</h5>
                                                </div>
                                                <div class="col text-right">
                                                    <div class="btn-group" role="group"><button class="btn btn-outline-info btn-sm" type="button"><i class="fas fa-file-download"></i>&nbsp;Download Generated Forms</button></div>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-bordered table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
                                                <table class="table table-bordered table-hover table-sm dataTable my-0" id="dataTable">
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
                                                        <div class="col"><span class="span-billing-label-small-size">Reference Number</span></div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col"><span class="span-billing-small-size">FHE-UP-2019-2020-1-1</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 offset-xl-4">
                                                <div class="form-group input-style">
                                                    <div class="form-row">
                                                        <div class="col"><span class="span-billing-label-small-size">Date of Submission</span></div>
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
                                                        <div class="col"><span class="span-billing-label-small-size">Academic Year</span></div>
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
                                                        <div class="col"><span class="span-billing-label-small-size">Total No. of Beneficiaries</span></div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col"><span class="text-danger span-billing-size">123,456,789</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group input-style">
                                                    <div class="form-row">
                                                        <div class="col"><span class="span-billing-label-small-size">Total Amount</span></div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col"><span class="text-danger span-billing-size">123,456,789</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive table-bordered table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
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
                                                        <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                                <a
                                                                    class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td class="text-left">Consolidated Billing Details (Form 2)</td>
                                                        <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                                <a
                                                                    class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td class="text-left">Consolidated Billing Details (Form 3)</td>
                                                        <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                                <a
                                                                    class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">4</td>
                                                        <td class="text-left">Notarized Registrar's Certification</td>
                                                        <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                                <a
                                                                    class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">5</td>
                                                        <td class="text-left">Certificate of Registration of Students (CORs)</td>
                                                        <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_link_cor"><i class="fas fa-file-upload"></i></a>
                                                                <a
                                                                    class="btn btn-outline-info" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="https://unifast.gov.ph/assets/pdf/guidelines/UniFAST_MC012022.pdf"
                                                                    target="_blank"><i class="far fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">6</td>
                                                        <td class="text-left">Bank Certification of the HEI Certified by the HEI</td>
                                                        <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                                <a
                                                                    class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">7</td>
                                                        <td class="text-left">Bank Certification of the HEI Certified by the Bank</td>
                                                        <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                                <a
                                                                    class="btn btn-outline-info" role="button" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
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
                                                <div class="form-group input-style"><label>Remarks</label><textarea class="form-control form-control-lg input-style" placeholder="Type your remarks here. . ."></textarea></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-xl-12 offset-xl-0">
                                                <div class="form-group input-style">
                                                    <p class="text-right"><button class="btn btn-outline-info btn-sm" type="button" data-toggle="modal" data-target="#mod_submit_final_billing"><i class="far fa-paper-plane"></i>&nbsp;Submit Final Billing</button></p>
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
                                            <div class="col"><span class="span-billing-label-small-size">Reference Number</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-small-size">FHE-UP-2019-2020-1-1</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 offset-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-label-small-size">Date of Submission</span></div>
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
                                            <div class="col"><span class="span-billing-label-small-size">Academic Year</span></div>
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
                                            <div class="col"><span class="span-billing-label-small-size">Total No. of Beneficiaries</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span class="text-danger span-billing-size">123,456,789</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group input-style">
                                        <div class="form-row">
                                            <div class="col"><span class="span-billing-label-small-size">Total Amount</span></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col"><span class="text-danger span-billing-size">123,456,789</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table-bordered table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
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
                                            <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div role="group" class="btn-group btn-group-sm"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                    <a
                                                        class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="text-left">Consolidated Billing Details (Form 2)</td>
                                            <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div role="group" class="btn-group btn-group-sm"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                    <a
                                                        class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="text-left">Consolidated Billing Details (Form 3)</td>
                                            <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div role="group" class="btn-group btn-group-sm"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                    <a
                                                        class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td class="text-left">Notarized Registrar&#39;s Certification</td>
                                            <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div role="group" class="btn-group btn-group-sm"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                    <a
                                                        class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td class="text-left">Certificate of Registration of Students (CORs)</td>
                                            <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div role="group" class="btn-group btn-group-sm"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_link_cor"><i class="fas fa-file-upload"></i></a>
                                                    <a
                                                        class="btn btn-outline-info" role="button" data-toggle="tooltip" data-placement="bottom" title="View billing submission" href="https://unifast.gov.ph/assets/pdf/guidelines/UniFAST_MC012022.pdf" target="_blank"><i class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td class="text-left">Bank Certification of the HEI Certified by the HEI</td>
                                            <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div role="group" class="btn-group btn-group-sm"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                    <a
                                                        class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td class="text-left">Bank Certification of the HEI Certified by the Bank</td>
                                            <td class="text-center"><span class="badge badge-pill badge-warning input-style">For Review</span></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <div role="group" class="btn-group btn-group-sm"><a class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_upload_signed_forms"><i class="fas fa-file-upload"></i></a>
                                                    <a
                                                        class="btn btn-outline-info" role="button" data-toggle="modal" data-placement="bottom" title="View billing submission" href="Admin/billinginformation.html" data-target="#mod_view_uploaded_file"><i class="far fa-eye"></i></a>
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
                                    <div class="form-group input-style"><label>Remarks</label><textarea class="form-control form-control-lg input-style" placeholder="Type your remarks here. . ."></textarea></div>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_new_student_info">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">TYPE OF ACTION</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <div class="form-group input-style">
                            <h6 class="modal-title text-dark">Personal Information</h6>
                        </div>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Lastname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Firstname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Middlename</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col-xl-1">
                                    <div class="form-group"><label>Extension</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Sex</label><select class="form-control input-style"><optgroup label="Select Sex"><option value="">--Select Sex--</option><option value="Male">Male</option><option value="Female">Female</option></optgroup></select></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthdate</label><input class="form-control input-style" type="date"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthplace</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Mother's Lastname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Mother's Firstname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Mother's Middlename</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Father's Lastname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Father's Firstname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Father's Middlename</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <h6 class="modal-title text-dark">Present Address</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Province</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;City</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Barangay</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>House /Building No./Street</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Zip Code</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-xl-9">
                                    <div class="form-group">
                                        <h6 class="modal-title text-dark">Permanent Address</h6>
                                    </div>
                                </div>
                                <div class="col-xl-3 text-right">
                                    <div class="custom-control custom-checkbox"><input class="custom-control-input check-style" type="checkbox" id="formCheck-7"><label class="custom-control-label" for="formCheck-7" style="padding-top: 3px;">Present Address</label></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Province</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;City</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Barangay</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>House /Building No./Street</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Zip Code</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <h6 class="modal-title text-dark">Contact Information</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Mobile Number</label><input class="form-control input-style" type="number"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Alternative Mobile Number (if available)</label><input class="form-control input-style" type="number"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Email Address</label><input class="form-control input-style" type="email"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Alternative Email Address (if available)</label><input class="form-control input-style" type="email"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <h6 class="modal-title text-dark">Enrollment Information</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Course Enrolled</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Year Level</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Total No. of Units Enrolled</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Amount of Tuition Fee</label><input class="form-control input-style" type="number" min="0" readonly=""></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1"><label class="custom-control-label check-style" for="formCheck-1">With National Service Training Program (NSTP)?</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Total NSTP Unit Taken</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Amount of NSTP</label><input class="form-control input-style" type="number" min="0" readonly=""></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-11"><label class="custom-control-label check-style" for="formCheck-11">Transferee</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <p class="input-style">&nbsp;Select additional fees to be charge:<br></p>
                                        <div class="custom-control custom-control-inline custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-12"><label class="custom-control-label check-style" for="formCheck-12">Entrance Fee</label></div>
                                        <div class="custom-control custom-control-inline custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-13"><label class="custom-control-label check-style" for="formCheck-13">Admission Fee</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6">
                                    <div class="form-group"><label>Entrance Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Admission Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Athletic Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Computer Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Cultural Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Development Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Guidance Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Handbook Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Laboratory Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Library Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Medical and Dental Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Registration Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6">
                                    <div class="form-group"><label>School ID Fee</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <p>Upload Certificate of Registration</p><input type="file"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Remarks</label><textarea class="form-control input-style" placeholder="Enter remarks here . . ."></textarea></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style" type="button">Save</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_admission_entrance">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">TYPE OF ACTION</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <div class="form-group input-style">
                            <h6 class="modal-title text-dark">Personal Information</h6>
                        </div>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Lastname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Firstname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Middlename</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col-xl-1">
                                    <div class="form-group"><label>Extension</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Sex</label><select class="form-control input-style"><optgroup label="Select Sex"><option value="">--Select Sex--</option><option value="Male">Male</option><option value="Female">Female</option></optgroup></select></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthdate</label><input class="form-control input-style" type="date"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthplace</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <h6 class="modal-title text-dark">Contact Information</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Mobile Number</label><input class="form-control input-style" type="number"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Alternative Mobile Number (if available)</label><input class="form-control input-style" type="number"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Email Address</label><input class="form-control input-style" type="email"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Alternative Email Address (if available)</label><input class="form-control input-style" type="email"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <h6 class="modal-title text-dark">Application Information</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1"><label class="custom-control-label check-style" for="formCheck-1">Transferee</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Course Applied</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Year Level</label><input class="form-control input-style" type="number" min="1"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>No. of times the student has taken the exam</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group"><label>Amount</label><input class="form-control input-style" type="number" min="0"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Exam Result</label><select class="form-control input-style"><option value="undefined" selected="">--Select Exam Result--</option><option value="Passed">Passed</option><option value="Failed">Failed</option></select></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Enrollment Status</label><select class="form-control input-style"><option value="undefined" selected="">--Select Enrollment Status--</option><option value="Enrolled">Enrolled</option><option value="Did not Enroll">Did not Enroll</option></select></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style" type="button">Save</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_nstp_info">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">NSTP Information</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <div class="form-group input-style">
                            <h6 class="modal-title text-dark">Personal Information</h6>
                        </div>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Lastname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Firstname</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Middlename</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col-xl-1">
                                    <div class="form-group"><label>Extension</label><input class="form-control input-style" type="text"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <h6 class="modal-title text-dark">Enrollment Information</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Course Enrolled</label><input class="form-control input-style" type="text"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Current Year Level</label><input class="form-control input-style" type="number"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <h6 class="modal-title text-dark">NSTP Information</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>Year Level</label><input class="form-control input-style" type="number"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label>Semester</label><input class="form-control input-style" type="number"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Remarks</label><select class="form-control input-style"><option value="undefined" selected="">--Select NSTP Result--</option><option value="Passed">Passed</option><option value="Failed">Failed</option></select></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style" type="button">Save</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_upload">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">UPLOAD FHE TEMPLATE</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><input type="file" data-toggle="tooltip" data-bs-tooltip="" title="Select file to upload"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style" type="button">Upload</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_view_uploaded_file">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">FHE-UP-2019-2020-1-1-FORM 1</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col"><iframe src="https://unifast.gov.ph/assets/pdf/guidelines/UniFAST_MC022022.pdf" width="100%" height="500" style="overflow:hidden" scrolling="yes" frameborder="3" allowTransparency="true"></iframe></div>
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
                        <h6 class="modal-title">UPLOAD SIGNED BILLING FORMS</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>File Name</label><input class="form-control input-style" type="text" value="FHE-UP-2019-2020-1-1-Form 1"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><input type="file" data-toggle="tooltip" data-bs-tooltip="" title="Select file to upload"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style" type="button">Upload</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_upload_link_cor">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">UPLOAD GDRIVE LINK</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <div class="form-group input-style">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label>URL Link</label><input class="form-control input-style" type="text" value="https://drive.google.com/drive/u/0/my-drive"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style" type="button">Upload</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_billing_checker">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">Run Billing Checker Confirmation</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body"><label>Are you sure you want to run billing checker? This will take sometime.</label></div>
                    <div class="modal-footer"><button id="btn_no" class="btn btn-danger card-button-style" type="button" data-dismiss="modal">Cancel</button><button id="btn_yes" class="btn btn-primary card-button-style" type="button" data-dismiss="modal">Yes</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_submit_final_billing">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">Submit Billing Confirmation</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body"><label>Are you sure you want to submit this final billing? This will disable you from editing the forms.</label></div>
                    <div class="modal-footer"><button class="btn btn-danger card-button-style" type="button" data-dismiss="modal">Cancel</button><a class="btn btn-primary card-button-style" role="button" href="listofbillings.html">Submit</a></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="mod_remove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h6 class="modal-title">Remove Student Confirmation</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body"><label>Are you sure you want to remove this student from the list?</label></div>
                    <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-danger card-button-style" type="button">Confirm</button></div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js')}}"></script>
    <script type="text/javascript" src="{{url('js\bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js\jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js\chart.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js\bs-init.js')}}"></script>
    <script type="text/javascript" src="{{url('js\theme.js')}}"></script>
    <script type="text/javascript" src="{{url('js\showandhide.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>

</body>

</html>