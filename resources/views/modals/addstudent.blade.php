<div id="mod_new_student_info" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id='frm_add_student' method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">ADD STUDENT</h6><button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-style">
                        <h6 class="modal-title text-dark">Personal Information</h6>
                    </div>
                    <div class="form-group input-style">
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
                            <div class="col-xl-1">
                                <div class="form-group"><label>Extension</label><input name='extension_name' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Sex</label><select name='sex' class="form-control input-style">
                                        <optgroup label="Select Sex">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </optgroup>
                                    </select></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthdate</label><input id="birthdate" name='birthdate' class="date form-control input-style"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Birthplace</label><input name='birthplace' class="form-control input-style" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Mother's Lastname</label><input name='m_lname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Mother's Firstname</label><input name='m_fname' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Mother's Middlename</label><input name='m_mname' class="form-control input-style" type="text"></div>
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
                                <div class="custom-control custom-checkbox"><input class="custom-control-input check-style" type="checkbox" id="formCheck-7"><label class="custom-control-label" for="formCheck-7" style="padding-top: 3px;">Present Address</label></div>
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
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Course Enrolled</label><input name='course_enrolled' class="form-control input-style" type="text"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Year Level</label><input name='year_level' class="form-control input-style" type="number" min="0"></div>
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Total No. of Units Enrolled</label><input name='total_unit' class="form-control input-style" type="number" min="0"></div>
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
                                <div class="form-group"><label><span class="text-danger">*</span>&nbsp;Total NSTP Unit Taken</label><input name='nstp_unit' class="form-control input-style" type="number" min="0"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Amount of NSTP</label><input class="form-control input-style" type="number" min="0" readonly=""></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox"><input name='transferee' class="custom-control-input" type="checkbox" id="formCheck-11"><label class="custom-control-label check-style" for="formCheck-11">Transferee</label></div>
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
                                    <p>Upload Certificate of Registration</p><input type="file">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Remarks</label><textarea class="form-control input-style" placeholder="Enter remarks here . . ."></textarea></div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button" data-bs-dismiss="modal">Close</button><button id="btn_add_student" class="add_student btn btn-primary card-button-style" type="submit">Add Student</button></div>
            </form>
        </div>
    </div>
</div>