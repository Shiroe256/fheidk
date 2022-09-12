<div id="mod_new_student_info" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id='frm_add_student' method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">ADD STUDENT</h6><button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group input-style campus_div d-none">
                        <h6 class="modal-title text-dark">Campus</h6>
                    </div>
                    <div class="form-group input-style campus_div d-none">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="hidden" name="ac_year" id="ac_year" value="{{ $ac_year }}">
                                    <input type="hidden" name="semester" id="semester" value="{{ $semester }}">
                                    <input type="hidden" name="tranche" id="tranche" value="{{ $tranche }}">
                                    <input type="hidden" id='hei_psg_region' name='hei_psg_region'value="{{ $hei_psg_region }}">
                                    <input type="hidden" id="reference_no" name="reference_no" value="{{ $reference_no }}">
                                    <input type="hidden" id='hei_uii' name='hei_uii' type="text">
                                    <input type="hidden" id='selected_campus' name='selected_campus' type="text">
                                    <select id="hei_campus" name="hei_campus" class="form-control input-style-tabs">                           
                                        <option selected disabled>-- Select Campus --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group input-style">
                        <h6 class="modal-title text-dark">Personal Information</h6>
                    </div>
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Student ID</label><input id='stud_id' name='stud_id' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>LRN No.</label><input id="lrn_no" name='lrn_no' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Lastname</label><input name='last_name' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Firstname</label><input name='first_name' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Middlename</label><input name='middle_name' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Extension</label><input name='extension_name' class="form-control input-style" type="text"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span>&nbsp;Sex</label>
                                     <select name='sex' class="form-control input-style">
                                        <optgroup label="Select Sex">
                                            <option value="" selected disabled>--Select Sex--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthdate</label>
                                    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text icon-container"><i class="fa fa-calendar-o"></i></span></div><input id="birthdate" name='birthdate' class="date form-control input-style" autocomplete="off" onkeydown="return false;" >
                                </div>
                                    
                            </div>
                        </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthplace</label><input name='birthplace' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Mother's Maiden Lastname</label><input name='m_lname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Mother's Firstname</label><input name='m_fname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Mother's Middlename</label><input name='m_mname' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Father's Lastname</label><input name='f_lname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Father's Firstname</label><input name='f_fname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Father's Middlename</label><input name='f_mname' class="form-control input-style" type="text"></div>
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
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Province</label><input name='present_province' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;City</label><input name='present_city' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Barangay</label><input name='present_barangay' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>House /Building No./Street</label><input name='present_street' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Zip Code</label><input name='present_zipcode' class="form-control input-style" type="text"></div>
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
                                <div class="custom-control custom-checkbox"><input class="custom-control-input check-style" type="checkbox" id="checkbox_address" name="checkbox_address"><label class="custom-control-label" for="checkbox_address" style="padding-top: 3px;">Present Address</label></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Province</label><input name='permanent_province' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;City</label><input name='permanent_city' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Barangay</label><input name='permanent_barangay' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>House /Building No./Street</label><input name='permanent_street' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Zip Code</label><input name='permanent_zipcode' class="form-control input-style" type="text"></div>
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
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Mobile Number</label><input name='mobile_number' class="form-control input-style" type="number"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Alternative Mobile Number (if available)</label><input name='alt_mobile_number' class="form-control input-style" type="number"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Email Address</label><input name='email_address' class="form-control input-style" type="email"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Alternative Email Address (if available)</label><input name='alt_email_address' class="form-control input-style" type="email"></div>
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
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Course Enrolled</label>
                                    <input id='degree_program' name='degree_program' type="hidden" class="form-control input-style" type="text">
                                    <select id='course_enrolled' name='course_enrolled' class="form-control input-style">
                                            <option value="" selected disabled>--Select Degree Program--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Year Level</label><input id='year_level' name='year_level' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Total No. of Units Enrolled</label><input id='total_unit' name='total_unit' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Amount of Tuition Fee</label><input id='total_tuition' name='total_tuition' class="form-control input-style" type="number" min="0" readonly=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox"><input id="checkbox_nstp" name="checkbox_nstp" class="custom-control-input" type="checkbox"><label class="custom-control-label check-style" for="checkbox_nstp">With National Service Training Program (NSTP)?</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="input_nstp form-row d-none">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Total NSTP Unit Taken</label><input id='nstp_unit' name='nstp_unit' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Amount of NSTP</label><input id='total_nstp' name='total_nstp' class="form-control input-style" type="number" min="0" readonly=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input id="checkbox_transferee" name="checkbox_transferee" class="custom-control-input" type="checkbox" value="Yes"><label class="custom-control-label check-style" for="checkbox_transferee">Transferee</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input_transferee form-row d-none">
                            <div class="col-xl-6">
                                <div class="form-group"><label>Entrance Fee</label><input id="entrance_fee" name="entrance_fee" class= "form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Admission Fee</label><input id="admission_fee" name="admission_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Athletic Fee</label><input id="athletic_fee" name="athletic_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Computer Fee</label><input id="computer_fee" name="computer_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Cultural Fee</label><input id="cultural_fee" name="cultural_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Development Fee</label><input id="development_fee" name="development_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Guidance Fee</label><input id="guidance_fee" name="guidance_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Handbook Fee</label><input id="handbook_fee" name="handbook_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Laboratory Fee</label><input id="laboratory_fee" name="laboratory_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Library Fee</label><input id="library_fee" name="library_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Medical and Dental Fee</label><input id="medical_dental_fee" name="medical_dental_fee"class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Registration Fee</label><input id="registration_fee" name="registration_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6">
                                <div class="form-group"><label>School ID Fee</label><input id="school_id_fee" name="school_id_fee" class="form-control input-style" type="number" min="0" max=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <p>Upload Certificate of Registration</p><input type="file">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Remarks</label><textarea id="remarks" name="remarks" class="form-control input-style" placeholder="Enter remarks here . . ."></textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-bs-dismiss="modal">Close</button><button id="btn_add_student" class="add_student btn btn-primary card-button-style" type="submit">Add Student</button></div>
            </form>
        </div>
    </div>
</div>