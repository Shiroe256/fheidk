<!---Student Information Form 2 Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="mod_student_info">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Student Information</h4><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="col"><input id="stud_uid" name="stud_uid" class="form-control" type="hidden">
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>FHE Award No.</label><input id="stud_fhe_award_no"
                                    name="stud_fhe_award_no" class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Student ID No.</label><input id="stud_id"
                                    name="stud_id" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5>Personal Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-3 col-xl-3"><label>Lastname</label><input id="stud_lname"
                                    name="stud_lname" class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Firstname</label><input id="stud_fname"
                                    name="stud_fname" class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Middlename</label><input id="stud_mname"
                                    name="stud_mname" class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Extension</label><input id="stud_extname"
                                    name="stud_extname" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Sex</label><input id="stud_sex" name="stud_sex"
                                    class="form-control" type="text">
                            </div>
                            <div class="col-lg-4 col-xl-4"><label>Birthdate</label><input id="stud_bdate"
                                    name="stud_bdate" class="form-control" type="date"></div>
                            <div class="col-lg-4 col-xl-4"><label>Birthplace</label><input id="stud_bplace"
                                    name="stud_bplace" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Mother's Lastname</label><input id="stud_mother_lname"
                                    name="stud_mother_lname" class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Mother's Firstname</label><input
                                    id="stud_mother_fname" name="stud_mother_fname" class="form-control" type="text">
                            </div>
                            <div class="col-lg-4 col-xl-4"><label>Mother's Middlename</label><input
                                    id="stud_mother_mname" name="stud_mother_mname" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Father's Lastname</label><input id="stud_father_lname"
                                    name="stud_father_lname" class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Father's Firstname</label><input
                                    id="stud_father_fname" name="stud_father_fname" class="form-control" type="text">
                            </div>
                            <div class="col-lg-4 col-xl-4"><label>Father's Middlename</label><input
                                    id="stud_father_mname" name="stud_father_mname" class="form-control"
                                    type="text">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Present Address</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Province</label><input id="stud_present_province"
                                    name="stud_present_province" class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>City</label><input id="stud_present_city"
                                    name="stud_present_city" class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Barangay</label><input id="stud_present_barangay"
                                    name="stud_present_barangay" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-9 col-xl-8"><label>House/Building No./Street</label><input
                                    id="stud_present_street" name="stud_present_street" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-3 col-xl-4"><label>Zip Code</label><input id="stud_present_zipcode"
                                    name="stud_present_zip" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="d-flex">Permanent Address</h5>
                        <div class="custom-control custom-checkbox"><input class="custom-control-input"
                                type="checkbox" id="chk_address" name="chk_address" disabled><label class="custom-control-label"
                                for="chk_address">Same with the
                                Present Address?</label></div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Province</label><input id="stud_permanent_province"
                                    name="stud_permanent_province" class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>City</label><input id="stud_permanent_city"
                                    name="stud_permanent_city" class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Barangay</label><input id="stud_permanent_barangay"
                                    name="stud_permanent_barangay" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-9 col-xl-8"><label>House/Building No./Street</label><input
                                    id="stud_permanent_street" name="stud_permanent_street" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-3 col-xl-4"><label>Zip Code</label><input id="stud_permanent_zipcode"
                                    name="stud_permanent_zip" class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Contact Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Mobile Number</label><input id="stud_contact"
                                    name="stud_contact" class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Alternative Mobile Number</label><input
                                    id="stud_alt_contact" name="stud_alt_contact" class="form-control"
                                    type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Email Address</label><input id="stud_email"
                                    name="stud_email" class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Alternative Email Address</label><input
                                    id="stud_alt_email" name="stud_alt_email" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Enrollment Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Course Enrolled</label><input
                                    id="stud_course_enrolled" name="stud_course_enrolled" class="form-control"
                                    type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Year Level</label><input id="stud_year_level"
                                    name="stud_year_level" class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Total No. of Academic Units</label><input
                                    id="stud_academic_units" name="stud_academic_units" class="form-control"
                                    type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Amount of Tuition Fee</label><input
                                    id="stud_tuition_amount" name="stud_tuition_amount" class="form-control"
                                    type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Total No. of Computer Laboratory Units</label><input
                                    id="stud_comp_lab_units" name="stud_comp_lab_units" class="form-control"
                                    type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Amount of Computer Laboratory</label><input
                                    id="stud_comp_lab_amount" name="stud_comp_lab_amount" class="form-control"
                                    type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Total No. of Laboratory Units</label><input
                                    id="stud_lab_units" name="stud_lab_units" class="form-control" type="number">
                            </div>
                            <div class="col-lg-6 col-xl-6"><label>Amount of Laboratory</label><input
                                    id="stud_lab_amount" name="stud_lab_amount" class="form-control" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Total No. of NSTP Units</label><input
                                    id="stud_nstp_units" name="stud_nstp_units" class="form-control" type="number">
                            </div>
                            <div class="col-lg-6 col-xl-6"><label>Amount of NSTP</label><input id="stud_nstp_amount"
                                    name="stud_nstp_amount" class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="custom-control custom-checkbox"><input class="custom-control-input"
                                        type="checkbox" id="stud_transferee" name="stud_transferee" disabled><label
                                        class="custom-control-label" for="stud_transferee">Transferee</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Entrance/Admission Fee</label><input
                                    id="stud_entrance_and_admission_fee" name="stud_entrance_and_admission_fee"
                                    class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Athletic Fee</label><input id="stud_athletic_fee"
                                    name="stud_athletic_fee" class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Computer Fee</label><input id="stud_computer_fee"
                                    name="stud_computer_fee" class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Cultural Fee</label><input id="stud_cultural_fee"
                                    name="stud_cultural_fee" class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Development Fee</label><input
                                    id="stud_development_fee" name="stud_development_fee" class="form-control"
                                    type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Guidance Fee</label><input id="stud_guidance_fee"
                                    name="stud_guidance_fee" class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Handbook Fee</label><input id="stud_handbook_fee"
                                    name="stud_handbook_fee" class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Laboratory Fee</label><input
                                    id="stud_laboratory_fee" name="stud_laboratory_fee" class="form-control"
                                    type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Library Fee</label><input id="stud_library_fee"
                                    name="stud_library_fee" class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Medical and Dental Fee</label><input
                                    id="stud_medical_and_dental_fee" name="stud_medical_and_dental_fee"
                                    class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Registration Fee</label><input
                                    id="stud_registration_fee" name="stud_registration_fee" class="form-control"
                                    type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>School ID Fee</label><input id="stud_school_id_fee"
                                    name="stud_school_id_fee" class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Total Fee</label><input id="stud_total_fee"
                                    name="stud_total_fee" class="form-control" type="number"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Remarks</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-12 col-xl-12">
                                <textarea id="stud_remarks" name="stud_remarks" class="form-control" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!---Student Information Form 2 Modal--->
