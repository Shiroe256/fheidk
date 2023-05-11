<!---Profile Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_profile">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">PROFILE</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col text-center"><img class="rounded-circle" src="{{url('admin/img/293228345_5209578979160533_6724701494728557606_n.jpg')}}" width="150" height="150"></div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col text-center">
                                <h5 class="font-weight-bold">CARLO E. MOLINA</h5>
                                <p class="text-muted profile-info">cmolina.unifast@ched.gov.ph</p>
                                <p class="text-muted profile-info">+639120799371</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
            </form>
        </div>
    </div>
</div>
<!---Profile Modal--->

<!---Reject Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_reject">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">REMARKS</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group"><textarea class="form-control" placeholder="Enter your remarks here. . ."></textarea></div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Confirm</button></div>
            </form>
        </div>
    </div>
</div>
<!---Reject Modal--->

<!---Approve Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_approve">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">REMARKS</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group"><textarea class="form-control" placeholder="Enter your remarks here. . .(Optional)"></textarea></div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Confirm</button></div>
            </form>
        </div>
    </div>
</div>
<!---Approve Modal--->

<!---Student Information Form 2 Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Student Information</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <h5>Campus</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col"><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5>Personal Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-3 col-xl-3"><label>Lastname</label><input class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Firstname</label><input class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Middlename</label><input class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Extension</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Sex</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Birthdate</label><input class="form-control" type="date"></div>
                            <div class="col-lg-4 col-xl-4"><label>Birthplace</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Mother's Lastname</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Mother's Firstname</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Mother's Middlename</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Father's Lastname</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Father's Firstname</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Father's Middlename</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5>Present Address</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Province</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>City</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Barangay</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-9 col-xl-8"><label>House/Building No./Street</label><input class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-4"><label>Zip Code</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="d-flex">Permanent Address</h5>
                        <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-1"><label class="custom-control-label" for="formCheck-1">Same with the Present Address?</label></div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Province</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>City</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Barangay</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-9 col-xl-8"><label>House/Building No./Street</label><input class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-4"><label>Zip Code</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Contact Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Mobile Number</label><input class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Alternative Mobile Number</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Email Address</label><input class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Alternative Email Address</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Enrollment Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Course Enrolled</label><input class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Year Level</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Total No. of Units Enrolled</label><input class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Amount of Tuition Fee</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-2"><label class="custom-control-label" for="formCheck-2">With National Service Training Program (NSTP)</label></div>
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-3"><label class="custom-control-label" for="formCheck-3">Transferee</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Entrance Fee</label><input class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Admission Fee</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Athletic Fee</label><input class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Computer Fee</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Cultural Fee</label><input class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Development Fee</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Guidance Fee</label><input class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Handbook Fee</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Laboratory Fee</label><input class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Library Fee</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Medical and Dental Fee</label><input class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Registration Fee</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>School ID Fee</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Remarks</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-12 col-xl-12"><textarea class="form-control"></textarea></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
            </form>
        </div>
    </div>
</div>
<!---Student Information Form 2 Modal--->

<!---Student Information Form 3 Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_2">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Applicant Information</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <h5>Campus</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col"><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5>Personal Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-3 col-xl-3"><label>Lastname</label><input class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Firstname</label><input class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Middlename</label><input class="form-control" type="text"></div>
                            <div class="col-lg-3 col-xl-3"><label>Extension</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 col-xl-4"><label>Sex</label><input class="form-control" type="text"></div>
                            <div class="col-lg-4 col-xl-4"><label>Birthdate</label><input class="form-control" type="date"></div>
                            <div class="col-lg-4 col-xl-4"><label>Birthplace</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Contact Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Mobile Number</label><input class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Alternative Mobile Number</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Email Address</label><input class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Alternative Email Address</label><input class="form-control" type="text"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="d-flex">Application Information</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-12">
                                <div class="custom-control custom-checkbox"><input class="custom-control-input" type="checkbox" id="formCheck-3"><label class="custom-control-label" for="formCheck-3">Transferee</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Course Enrolled</label><input class="form-control" type="text"></div>
                            <div class="col-lg-6 col-xl-6"><label>Year Level</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>No. of times the student has taken the exam</label><input class="form-control" type="number"></div>
                            <div class="col-lg-6 col-xl-6"><label>Amount</label><input class="form-control" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-6 col-xl-6"><label>Exam Result</label><select class="form-control">
                                    <optgroup label="--Select Result--">
                                        <option value="Passed" selected="">Passed</option>
                                        <option value="Failed">Failed</option>
                                    </optgroup>
                                </select></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
            </form>
        </div>
    </div>
</div>
<!---Student Information Form 3 Modal--->

<!---Scanned Copy Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_form_1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Scanned Copy</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://unifast.gov.ph/assets/pdf/guidelines/UniFAST_MC012022.pdf" allowfullscreen=""></iframe></div>
            </div>
            <div class="modal-footer"><button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#modal_reject">REJECT</button><button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#modal_approve">APPROVE</button></div>
        </div>
    </div>
</div>
<!---Scanned Copy Modal--->

<!---Upload TOSF Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_tosf">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title">UPLOAD TOSF</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body"><input type="file" name="file">
                <div class="input-group"></div>
                <div class="input-group">
                    <div class="input-group-prepend"></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Upload</button></div>
            </form>
        </div>
    </div>
</div>
<!---Upload TOSF Modal--->

<!---Add TOSF Modal--->
<div role="dialog" tabindex="-1" class="modal fade show" id="modal_add_tosf">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">ADD TOSF</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input name="hei_uii" id="hei_uii" value="{{ $heis->hei_uii }}">
                    <input name="hei_psg_region" id="hei_psg_region" value="{{ $heis->hei_psg_region }}">
                    <div class="form-group"><label>Degree Program</label><input id="add_tosf_program" name="add_tosf_program" type="text" class="form-control" /></div>
                    <div class="form-group"><label>Year Level</label><input id="add_tosf_year_level" name="add_tosf_year_level" type="number" class="form-control" min="1" max="6" /></div>
                    <div class="form-group"><label>Semester</label>
                        <select id="add_tosf_semester" name="add_tosf_semester" class="form-control">
                            <option selected disabled value="">-- Select Semester --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Type of Fee</label>
                        <select id="add_tosf_type_of_fee" name="add_tosf_type_of_fee" class="form-control">
                            <option selected disabled value="">-- Select Type of Fee --</option>
                            <option value="Admission">Admission</option>
                            <option value="Athletic">Athletic</option>
                            <option value="Computer">Computer</option>
                            <option value="Cultural">Cultural</option>
                            <option value="Development">Development</option>
                            <option value="Entrance">Entrance</option>
                            <option value="Guidance">Guidance</option>
                            <option value="Handbook">Handbook</option>
                            <option value="Laboratory">Laboratory</option>
                            <option value="Library">Library</option>
                            <option value="Medical and Dental">Medical and Dental</option>
                            <option value="Registration">Registration</option>
                            <option value="School ID">School ID</option>
                            <option value="Tuition">Tuition</option>
                            <option value="NSTP">NSTP</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Category</label><input id="add_tosf_category" name="add_tosf_category" type="text" class="form-control" /></div>
                    <div class="form-group"><label>Coverage</label>
                        <select id="add_tosf_coverage" name="add_tosf_coverage" class="form-control">
                            <option selected disabled value="">-- Select Coverage --</option>
                            <option value="per unit">per unit</option>
                            <option value="per subject">per subject</option>
                            <option value="per student">per student</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="chk_opt" /><label class="custom-control-label" for="chk_opt">Optional</label></div>
                    </div>
                    <div class="form-group"><label>Amount</label><input id="add_tosf_amount" name="add_tosf_amount" type="number" class="form-control" min="0" /></div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button id="btn_save_tosf" name="btn_save_tosf" class="btn btn-primary" type="submit">Save</button></div>
            </form>
        </div>
    </div>
</div>
<!---Add TOSF Modal--->

<!---Update TOSF Modal--->
<div role="dialog" tabindex="-1" class="modal fade show" id="modal_update_tosf">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">UPDATE TOSF</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label>Degree Program</label><input id="add_tosf_program" name="add_tosf_program" type="text" class="form-control" /></div>
                    <div class="form-group"><label>Year Level</label><input id="add_tosf_year_level" name="add_tosf_year_level" type="number" class="form-control" min="1" max="6" /></div>
                    <div class="form-group"><label>Semester</label>
                        <select id="add_tosf_semester" name="add_tosf_semester" class="form-control">
                            <option selected disabled value="">-- Select Semester --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Type of Fee</label>
                        <select id="add_tosf_type_of_fee" name="add_tosf_type_of_fee" class="form-control">
                            <option selected disabled value="">-- Select Type of Fee --</option>
                            <option value="Admission">Admission</option>
                            <option value="Athletic">Athletic</option>
                            <option value="Computer">Computer</option>
                            <option value="Cultural">Cultural</option>
                            <option value="Development">Development</option>
                            <option value="Entrance">Entrance</option>
                            <option value="Guidance">Guidance</option>
                            <option value="Handbook">Handbook</option>
                            <option value="Laboratory">Laboratory</option>
                            <option value="Library">Library</option>
                            <option value="Medical and Dental">Medical and Dental</option>
                            <option value="Registration">Registration</option>
                            <option value="School ID">School ID</option>
                            <option value="Tuition">Tuition</option>
                            <option value="NSTP">NSTP</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Category</label><input id="add_tosf_category" name="add_tosf_category" type="text" class="form-control" /></div>
                    <div class="form-group"><label>Coverage</label>
                        <select id="add_tosf_coverage" name="add_tosf_coverage" class="form-control">
                            <option selected disabled value="">-- Select Coverage --</option>
                            <option value="per unit">per unit</option>
                            <option value="per subject">per subject</option>
                            <option value="per student">per student</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="chk_opt" /><label class="custom-control-label" for="chk_opt">Optional</label></div>
                    </div>
                    <div class="form-group"><label>Amount</label><input id="add_tosf_amount" name="add_tosf_amount" type="number" class="form-control" min="0" /></div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button id="btn_update_tosf" name="btn_update_tosf" class="btn btn-primary" type="submit">Update</button></div>
            </form>
        </div>
    </div>
</div>
<!---Update TOSF Modal--->