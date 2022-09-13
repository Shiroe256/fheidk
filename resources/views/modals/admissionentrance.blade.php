<div class="modal fade" role="dialog" tabindex="-1" id="mod_admission_entrance">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id='frm_add_applicant' method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">ADD APPLICANTS</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
                                    <input type="hidden" id='hei_psg_region' name='hei_psg_region' value="{{ $hei_psg_region }}">
                                    <input type="hidden" id="reference_no" name="reference_no" value="{{ $reference_no }}">
                                    <input type="hidden" id='hei_uii' name='hei_uii' type="text">
                                    <input type="hidden" id='applied_selected_campus' name='applied_selected_campus' type="text">
                                    <select id="applied_hei_campus" name="applied_hei_campus" class="form-control input-style-tabs">                           
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
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Lastname</label><input id="last_name" name="last_name" type="text"class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Firstname</label><input id="first_name" name="first_name" class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Middlename</label><input id="middle_name" name="middle_name" class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col-xl-1">
                                <div class="form-group"><label>Extension</label><input id="extension_name" name="extension_name" class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Sex</label>
                                    <select id="sex" name="sex" class="form-control input-style">
                                        <optgroup label="Select Sex">
                                            <option value="">--Select Sex--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </optgroup>
                                    </select></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthdate</label>
                                    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text icon-container"><i class="fa fa-calendar-o"></i></span></div><input id="birthdate" name='birthdate' class="date form-control input-style" autocomplete="off" onkeydown="return false;" >
                                </div>   
                            </div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthplace</label><input id="birthplace" name='birthplace' class="form-control input-style" type="text"></div>
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
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Mobile Number</label><input id='mobile_number' name='mobile_number' class="form-control input-style" type="number"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Alternative Mobile Number (if available)</label><input id='alt_mobile_number' name='alt_mobile_number' class="form-control input-style" type="number"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Email Address</label><input id='email_address' name='email_address' class="form-control input-style" type="email"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Alternative Email Address (if available)</label><input id='alt_email_address' name='alt_email_address' class="form-control input-style" type="email"></div>
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
                                    <div class="custom-control custom-checkbox"><input id="checkbox_transferee_applicant" name="checkbox_transferee_applicant" class="custom-control-input" type="checkbox"><label class="custom-control-label check-style" for="checkbox_transferee_applicant">Transferee</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Course Enrolled</label>
                                    <input id='degree_program_applied' name='degree_program_applied' type="hidden" class="form-control input-style" type="text">
                                    <select id='course_applied' name='course_applied' class="form-control input-style">
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
                                <div class="form-group"><label>No. of times the student has taken the exam</label><input id='total_exam_taken' name='total_exam_taken' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group"><label>Amount</label><input id='total_amount' name='total_amount' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Exam Result</label><select id="exam_result" name="exam_result" class="form-control input-style">
                                        <option value="" selected>--Select Exam Result--</option>
                                        <option value="Passed">Passed</option>
                                        <option value="Failed">Failed</option>
                                    </select></div>
                            </div>
                            <div class="col">
                                {{-- <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Enrollment Status</label><select class="form-control input-style">
                                        <option value="undefined" selected="">--Select Enrollment Status--</option>
                                        <option value="Enrolled">Enrolled</option>
                                        <option value="Did not Enroll">Did not Enroll</option>
                                    </select></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary card-button-style" type="submit">Save</button></div>
            </form>
        </div>
    </div>
</div>