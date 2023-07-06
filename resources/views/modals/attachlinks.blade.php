<div id="mod_upload_link_form1" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frm_link_form1" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">ATTACH LINK FOR FORM 1</h6><button type="button" class="close"
                        data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col">
                                <input type="hidden" id="reference_no" name="reference_no" value="{{ $billings->reference_no }}">
                                <div class="form-group"><input id="link_form1" name="link_form1" class="form-control input-style" type="text" placeholder="https://drive.google.com/"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button"
                    data-bs-dismiss="modal">Close</button><button id="btn_attach_form1" name="btn_attach_form1" class="btn btn-primary card-button-style"
                        type="submit">Attach</button></div>
            </form>
        </div>
    </div>
</div>

<div id="mod_upload_link_form2" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frm_link_form2" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">ATTACH LINK FOR FORM 2</h6><button type="button" class="close"
                        data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-style">
                        <div class="form-row">
                            <div class="col">
                                <input type="hidden" id="reference_no" name="reference_no" value="{{ $billings->reference_no }}">
                                <div class="form-group"><input id="link_form2" name="link_form2" class="form-control input-style" type="text" placeholder="https://drive.google.com/"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light card-button-style" type="button"
                    data-bs-dismiss="modal">Close</button><button id="btn_attach_form2" name="btn_attach_form2" class="btn btn-primary card-button-style"
                        type="submit">Attach</button></div>
            </form>
        </div>
    </div>
</div>