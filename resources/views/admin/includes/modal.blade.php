<!---Profile Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_profile">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">PROFILE</h4><button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col text-center"><img class="rounded-circle"
                                    src="{{ url('admin/img/293228345_5209578979160533_6724701494728557606_n.jpg') }}"
                                    width="150" height="150"></div>
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
                <div class="modal-footer"><button class="btn btn-light" type="button"
                        data-dismiss="modal">Close</button></div>
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
                    <h4 class="modal-title">REMARKS</h4><button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Enter your remarks here. . ."></textarea>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button"
                        data-dismiss="modal">Close</button><button class="btn btn-primary"
                        type="button">Confirm</button></div>
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
                    <h4 class="modal-title">REMARKS</h4><button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Enter your remarks here. . .(Optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button"
                        data-dismiss="modal">Close</button><button class="btn btn-primary"
                        type="button">Confirm</button></div>
            </form>
        </div>
    </div>
</div>
<!---Approve Modal--->



<!---Scanned Copy Modal--->
<div class="modal fade" role="dialog" tabindex="-1" id="modal_form_1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Scanned Copy</h6><button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item"
                        src="https://unifast.gov.ph/assets/pdf/guidelines/UniFAST_MC012022.pdf"
                        allowfullscreen=""></iframe></div>
            </div>
            <div class="modal-footer"><button class="btn btn-outline-danger" type="button" data-toggle="modal"
                    data-target="#modal_reject">REJECT</button><button class="btn btn-outline-success" type="button"
                    data-toggle="modal" data-target="#modal_approve">APPROVE</button></div>
        </div>
    </div>
</div>
<!---Scanned Copy Modal--->