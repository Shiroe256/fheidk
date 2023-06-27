<!---Student Information Form 3 Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="mod_applicant_info">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Applicant Information</h4><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-row">
                            <input id="stud_uid" name="stud_uid" class="form-control" type="text">
                            <div class="col-lg-6 col-xl-6">
                                <label>Application ID</label>
                                <input id="applicant_app_id"
                                name="applicant_app_id" class="form-control" type="text">
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <label>FHE Award No.</label>
                                <input id="applicant_fhe_award_no"
                                name="applicant_fhe_award_no" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Personal Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-3 col-xl-3"><label>Lastname</label><input id="applicant_lname" name="applicant_lname" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Firstname</label><input id="applicant_fname" name="applicant_fname" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Middlename</label><input id="applicant_mname" name="applicant_mname" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Extension</label><input id="applicant_ext_name" name="applicant_ext_name" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Sex</label><input id="applicant_sex" name="applicant_sex" class="form-control" type="text">
                            </div>
                            <div class="col-lg-4 col-xl-4"><label>Birthdate</label><input id="applicant_bdate" name="applicant_bdate" class="form-control"
                                    type="date"></div>
                            <div class="col-lg-4 col-xl-4"><label>Birthplace</label><input id="applicant_bplace" name="applicant_bplace" class="form-control"
                                    type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Contact Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Mobile Number</label><input id="applicant_contact" name="applicant_contact" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Alternative Mobile Number</label><input
                                id="applicant_alt_contact" name="applicant_alt_contact" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Email Address</label><input id="applicant_email" name="applicant_email" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Alternative Email Address</label><input
                                id="applicant_alt_email" name="applicant_alt_email" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Application Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-12">
                                <div class="custom-control custom-checkbox"><input class="custom-control-input"
                                        type="checkbox" id="chk_transferee" name="chk_transferee"><label class="custom-control-label"
                                        for="chk_transferee">Transferee</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Course Enrolled</label><input id="applicant_course" name="applicant_course" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Year Level</label><input id="applicant_year_level" name="applicant_year_level" class="form-control"
                                    type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>No. of times the student has taken the
                                    exam</label><input id="applicant_total_exam_taken" name="applicant_total_exam_taken" class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Amount</label><input id="applicant_total_amount" name="applicant_total_amount" class="form-control"
                                    type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6">
                                <label>Exam Result</label>
                                <input id="applicant_exam_result" name="applicant_exam_result" class="form-control"
                                    type="text">
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <label>Exam Result</label>
                                <input id="applicant_status" name="applicant_status" class="form-control"
                                    type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary d-none" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!---Student Information Form 3 Modal--->
