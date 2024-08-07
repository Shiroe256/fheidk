<!---Open Billing Modal--->
<div role="dialog" tabindex="-1" class="modal fade" id="mod_open_billing">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frm_open_billing">
                <div class="modal-header">
                    <h4 class="modal-title">Open New Billing</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label>Academic Year</label>
                        <select id="open_billing_ac_year" name="open_billing_ac_year"class="form-control" required>
                            <option value="" disabled selected>-- Select Academic Year --</option>
                            <option value="2023-2024">2021-2022</option>
                            <option value="2024-2025">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Semester</label>
                        <select id="open_billing_semester" name="open_billing_semester" class="form-control" required>
                            <option value="" disabled selected>-- Select Semester --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group"><label>HEI Name</label>
                        <select id="open_billing_hei" name="open_billing_hei" class="form-control" required>
                            <option value="" disabled selected>-- Select HEI --</option>
                            <option value="All">All HEIs</option>
                            @foreach($heis as $hei)
                                <option value="{{ $hei->hei_uii }}">{{ $hei->hei_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                    <button id="btn_open_billing" class="btn btn-primary" type="submit">Open Billing</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!---Open Billing Modal--->