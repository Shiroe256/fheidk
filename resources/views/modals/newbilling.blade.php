<div class="modal fade" role="dialog" tabindex="-1" id="mod_add_new_ay">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">FHE Management</h6><button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label>Academic Year</label>
                                    <select id="ac_year" class="form-control input-style">
                                        <option value="" selected="">--Select Academic Year--</option>
                                        <option value="2020-2021">2020-2021</option>
                                        <option value="2021-2022">2021-2022</option>
                                    </select>
                                </div>
                                <div class="form-group"><label>Semester</label>
                                    <select id="semester" class="form-control input-style">
                                        <option value="" selected="">--Select Semester--</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                        <option value="3rd">3rd</option>
                                        <option value="Summer">Summer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button"
                        data-dismiss="modal">Close</button>
                    <a class="btn btn-primary card-button-style" role="button"
                        href="{{ route('billingmanagement') }}">Next</a>
                </div>
            </form>
        </div>
    </div>
