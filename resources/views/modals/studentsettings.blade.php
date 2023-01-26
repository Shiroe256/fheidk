<div class="modal fade" role="dialog" tabindex="-1" id="mod_stud_settings">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary">Student Billing Settings</h6><button type="button" class="close"
                    data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <input type="hidden" id="studuid">
            </div>
            <div class="modal-body">
                <div class="p-2">
                    Settings for <strong id="lbl_name"></strong>
                </div>
                <div id="settings-placeholder">
                    <div class="row p-3">
                        <div class="accordion w-100">
                            <div class="card p-3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <div class="skeleton skeleton-text"></div>
                                    </h2>
                                    <div class="skeleton skeleton-text skeleton-body"></div>
                                    <div class="skeleton skeleton-text"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="frm_stud_settings" class="modal-body">

                </div>
            </div>
            <div class="modal-footer d-none"><button id="btn_save_student_settings"
                    class="add_student btn btn-primary card-button-style">Save</button>
                <div id="loader"></div>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
