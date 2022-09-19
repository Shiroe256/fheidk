<div id="mod_edit_student_info" class="modal fade" role="dialog" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id='frm_update_student' method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title text-primary">EDIT STUDENT</h6><button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group input-style campus_div d-none">
                        <h6 class="modal-title">Campus</h6>
                    </div>
                    <div class="form-group input-style campus_div d-none">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="hidden" name="edit_ac_year" id="edit_ac_year" value="{{ $ac_year }}">
                                    <input type="hidden" name="edit_semester" id="edit_semester" value="{{ $semester }}">
                                    <input type="hidden" name="edit_tranche" id="edit_tranche" value="{{ $tranche }}">
                                    <input type="hidden" id='edit_hei_psg_region' name='edit_hei_psg_region'value="{{ $hei_psg_region }}">
                                    <input type="hidden" id="edit_reference_no" name="edit_reference_no" value="{{ $reference_no }}">
                                    <input type="hidden" id='edit_hei_uii' name='edit_hei_uii' type="text">
                                    <input type="hidden" id='edit_selected_campus' name='edit_selected_campus'>
                                    <?php
                                        $hei_sid = Auth::user()->hei_sid;
                                        if (empty($hei_sid)) {
                                            return response()->json(0);
                                        } else {
                                            echo'<select id="edit_hei_campus" name="edit_hei_campus" class="form-control input-style-tabs">                           
                                                <option disabled>-- Select Campus --</option>';
                                            $hei = DB::table('tbl_heis')->where('hei_sid', $hei_sid)->get();
                                            if ($hei->count() > 0) {
                                                foreach ($hei as $hei_campus) {
                                                    echo'<option>'. $hei_campus->hei_name .'</option>';
                                                }
                                            }
                                            echo'</select>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group input-style">
                        <h6 class="modal-title">Personal Information</h6>
                    </div>
                    <div class="form-group input-style">
                        <div class="form-row">
                            <input type="hidden" name="edit_student_id" id="edit_student_id">
                            {{-- <input type="hidden" name="student_id" id="student_id"> --}}
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Lastname</label><input id='edit_last_name' name='edit_last_name' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Firstname</label><input id='edit_first_name' name='edit_first_name' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Middlename</label><input id='edit_middle_name' name='edit_middle_name' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col-xl-1">
                                <div class="form-group"><label>Extension</label><input id='edit_extension_name' name='edit_extension_name' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span>&nbsp;Sex</label>
                                     <select id='edit_sex' name='edit_sex' class="form-control input-style">
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
                                    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text icon-container"><i class="fa fa-calendar-o"></i></span></div><input id="edit_birthdate" name='edit_birthdate' class="date form-control input-style" autocomplete="off" onkeydown="return false;" >
                                </div>   
                            </div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthplace</label><input id='edit_birthplace' name='edit_birthplace' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Mother's Lastname</label><input id='edit_m_lname' name='edit_m_lname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Mother's Firstname</label><input id='edit_m_fname' name='edit_m_fname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Mother's Middlename</label><input id='edit_m_mname' name='edit_m_mname' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Father's Lastname</label><input id='edit_f_lname' name='edit_f_lname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Father's Firstname</label><input id='edit_f_fname' name='edit_f_fname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Father's Middlename</label><input id='edit_f_mname' name='edit_f_mname' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <h6 class="modal-title">Present Address</h6>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Province</label><input id='edit_present_province' name='edit_present_province' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;City</label><input id='edit_present_city' name='edit_present_city' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Barangay</label><input id='edit_present_barangay' name='edit_present_barangay' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>House /Building No./Street</label><input id='edit_present_street' name='edit_present_street' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Zip Code</label><input id='edit_present_zipcode' name='edit_present_zipcode' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <h6 class="modal-title">Permanent Address</h6>
                                </div>
                            </div>
                            <div class="col-xl-3 text-right">
                                <div class="custom-control custom-checkbox"><input class="custom-control-input check-style" type="checkbox" id="edit_checkbox_address" name="edit_checkbox_address"><label class="custom-control-label" for="edit_checkbox_address" style="padding-top: 3px;">Present Address</label></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Province</label><input id='edit_permanent_province' name='edit_permanent_province' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;City</label><input id='edit_permanent_city' name='edit_permanent_city' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Barangay</label><input id='edit_permanent_barangay' name='edit_permanent_barangay' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>House /Building No./Street</label><input id='edit_permanent_street' name='edit_permanent_street' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Zip Code</label><input id='edit_permanent_zipcode' name='edit_permanent_zipcode' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <h6 class="modal-title">Contact Information</h6>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Mobile Number</label><input id='edit_mobile_number' name='edit_mobile_number' class="form-control input-style" type="number"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Alternative Mobile Number (if available)</label><input id='edit_alt_mobile_number' name='edit_alt_mobile_number' class="form-control input-style" type="number"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Email Address</label><input id='edit_email_address' name='edit_email_address' class="form-control input-style" type="email"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Alternative Email Address (if available)</label><input id='edit_alt_email_address' name='edit_alt_email_address' class="form-control input-style" type="email"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <h6 class="modal-title">Enrollment Information</h6>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Course Enrolled</label>
                                    <input id='edit_degree_program' name='edit_degree_program' type="hidden" class="form-control input-style" type="text">
                                    <?php
                                            echo' <select id="edit_course_enrolled" name="edit_course_enrolled" class="form-control input-style">
                                            <option value="" selected disabled>--Select Degree Program--</option>';
                                            $selectDegreePrograms = DB::table('tbl_other_school_fees')
                                            ->select('course_enrolled')
                                            ->where('hei_uii', Auth::user()->hei_uii)
                                            ->groupby('course_enrolled')
                                            ->get();
                                            if ($selectDegreePrograms->count() > 0) {
                                                foreach ($selectDegreePrograms as $degree) {
                                                    echo'<option>'. $degree->course_enrolled .'</option>';
                                                }
                                            }
                                            echo'</select>';
                                    ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Year Level</label><input id='edit_year_level' name='edit_year_level' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Total No. of Units Enrolled</label><input name='edit_total_unit' id='edit_total_unit' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Amount of Tuition Fee</label><input name='edit_tuition_fee' id='edit_tuition_fee' class="form-control input-style" type="number" min="0" readonly=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox"><input name='edit_with_nstp' id='edit_with_nstp' class="custom-control-input" type="checkbox"><label class="custom-control-label check-style" for="edit_with_nstp">With National Service Training Program (NSTP)?</label></div>
                                </div>
                            </div>
                        </div>
                        <div id="nstp_div" name="nstp_div" class="form-row d-none">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Total NSTP Unit Taken</label><input name='edit_nstp_unit' id='edit_nstp_unit' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Amount of NSTP</label><input name='edit_nstp_fee' id='edit_nstp_fee' class="form-control input-style" type="number" min="0" readonly=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox"><input id='edit_checkbox_transferee' name='edit_checkbox_transferee' class="custom-control-input" type="checkbox" value="Yes"><label class="custom-control-label check-style" for="edit_checkbox_transferee">Transferee</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6">
                                <div class="form-group"><label>Entrance Fee</label><input id='edit_entrance_fee' name='edit_entrance_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Admission Fee</label><input id='edit_admission_fee' name='edit_admission_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Athletic Fee</label><input id='edit_athletic_fee' name='edit_athletic_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Computer Fee</label><input id='edit_computer_fee' name='edit_computer_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Cultural Fee</label><input id='edit_cultural_fee' name='edit_cultural_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Development Fee</label><input id='edit_development_fee' name='edit_development_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Guidance Fee</label><input id='edit_guidance_fee' name='edit_guidance_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Handbook Fee</label><input id='edit_handbook_fee' name='edit_handbook_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Laboratory Fee</label><input id='edit_laboratory_fee' name='edit_laboratory_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Library Fee</label><input id='edit_library_fee' name='edit_library_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Medical and Dental Fee</label><input id='edit_medical_dental_fee' name='edit_medical_dental_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Registration Fee</label><input id='edit_registration_fee' name='edit_registration_fee' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6">
                                <div class="form-group"><label>School ID Fee</label><input id='edit_school_id_fee' name='edit_school_id_fee' class="form-control input-style" type="number" min="0"></div>
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
                                <div class="form-group"><label>Remarks</label><textarea id='edit_remarks' name='edit_remarks' class="form-control input-style" placeholder="Enter remarks here . . ."></textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-bs-dismiss="modal">Close</button><button id="btn_update_student" class="add_student btn btn-primary card-button-style" type="submit">Update Student</button></div>
            </form>
        </div>
    </div>
</div>