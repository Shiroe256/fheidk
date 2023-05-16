<!---Upload TOSF Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_tosf">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frm_upload_tosf" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">UPLOAD TOSF</h5><button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="upload_tosf_hei_uii" id="upload_tosf_hei_uii"
                        value="{{ $heis->hei_uii }}">
                    <input type="hidden" name="upload_tosf_hei_psg_region" id="upload_tosf_hei_psg_region"
                        value="{{ $heis->hei_psg_region }}">
                    <input type="hidden" name="upload_tosf_hei_name" id="upload_tosf_hei_name"
                        value="{{ $heis->hei_name }}">
                    <input type="file" name="file">
                    <div class="input-group"></div>
                    <div class="input-group">
                        <div class="input-group-prepend"></div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button"
                        data-dismiss="modal">Close</button><button id="btn_upload_tosf" name="btn_upload_tosf"
                        class="btn btn-primary" type="submit">Upload</button></div>
            </form>
        </div>
    </div>
</div>
<!---Upload TOSF Modal--->

<!---Add TOSF Modal--->
<div role="dialog" tabindex="-1" class="modal fade show" id="modal_add_tosf">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frm_add_tosf" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">ADD TOSF</h5><button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="add_tosf_hei_uii" id="add_tosf_hei_uii" value="{{ $heis->hei_uii }}">
                    <input type="hidden" name="add_tosf_hei_psg_region" id="add_tosf_hei_psg_region"
                        value="{{ $heis->hei_psg_region }}">
                    <input type="hidden" name="add_tosf_hei_name" id="add_tosf_hei_name" value="{{ $heis->hei_name }}">
                    <div class="form-group"><label>Degree Program</label><input id="add_tosf_degree_program"
                            name="add_tosf_degree_program" type="text" class="form-control" /></div>
                    <div class="form-group"><label>Year Level</label>
                        <select id="add_tosf_year_level" name="add_tosf_year_level" class="form-control">
                            <option selected disabled value="">-- Select Year --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
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
                    <div class="form-group"><label>Category</label><input id="add_tosf_category"
                            name="add_tosf_category" type="text" class="form-control" /></div>
                    <div class="form-group"><label>Coverage</label>
                        <select id="add_tosf_coverage" name="add_tosf_coverage" class="form-control">
                            <option selected disabled value="">-- Select Coverage --</option>
                            <option value="per unit">per unit</option>
                            <option value="per subject">per subject</option>
                            <option value="per student">per student</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Amount</label><input id="add_tosf_amount" name="add_tosf_amount"
                            type="number" class="form-control" min="0" /></div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="submit"
                        data-dismiss="modal">Close</button><button id="btn_save_tosf" name="btn_save_tosf"
                        class="btn btn-primary" type="submit">Save</button></div>
            </form>
        </div>
    </div>
</div>
<!---Add TOSF Modal--->

<!---Update TOSF Modal--->
<div role="dialog" tabindex="-1" class="modal fade show" id="modal_update_tosf">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id='frm_update_tosf' method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">UPDATE TOSF</h5><button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_tosf_hei_uii" id="update_tosf_hei_uii"
                        value="{{ $heis->hei_uii }}">
                    <input type="hidden" name="update_tosf_hei_psg_region" id="update_tosf_hei_psg_region"
                        value="{{ $heis->hei_psg_region }}">
                    <input type="hidden" name="update_tosf_hei_name" id="update_tosf_hei_name"
                        value="{{ $heis->hei_name }}">
                    <input type="hidden" name="update_tosf_id" id="update_tosf_id" />
                    <div class="form-group"><label>Degree Program</label><input id="update_tosf_program"
                            name="update_tosf_program" type="text" class="form-control" /></div>
                    <div class="form-group"><label>Year Level</label>
                        <select id="update_tosf_year_level" name="update_tosf_year_level" class="form-control">
                            <option selected disabled value="">-- Select Year --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Semester</label>
                        <select id="update_tosf_semester" name="update_tosf_semester" class="form-control">
                            <option selected disabled value="">-- Select Semester --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="Summer">Summer</option>
                            <option value="Graduation">Graduation</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Type of Fee</label>
                        <select id="update_tosf_type_of_fee" name="update_tosf_type_of_fee" class="form-control">
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
                    <div class="form-group"><label>Category</label><input id="update_tosf_category"
                            name="update_tosf_category" type="text" class="form-control" /></div>
                    <div class="form-group"><label>Coverage</label>
                        <select id="update_tosf_coverage" name="update_tosf_coverage" class="form-control">
                            <option selected disabled value="">-- Select Coverage --</option>
                            <option value="per unit">per unit</option>
                            <option value="per subject">per subject</option>
                            <option value="per student">per student</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Amount</label><input id="update_tosf_amount"
                            name="update_tosf_amount" type="number" class="form-control" min="0" /></div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="submit"
                        data-dismiss="modal">Close</button><button id="btn_update_tosf" name="btn_update_tosf"
                        class="btn btn-primary" type="submit">Update</button></div>
            </form>
        </div>
    </div>
</div>
<!---Update TOSF Modal--->
