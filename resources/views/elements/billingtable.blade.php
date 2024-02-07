<?php $f = new NumberFormatter('en', NumberFormatter::ORDINAL); ?>
<?php $format = new NumberFormatter('en_PH', NumberFormatter::CURRENCY); ?>
@if (count($billings) > 0)
    <div class="table-responsive table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
        <table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_listofbillings">
            <thead>
                <tr>
                    <th class="text-center">NO.</th>
                    <th class="text-center">REFERENCE NO.</th>
                    <th class="text-center">ACADEMIC YEAR</th>
                    <th class="text-center">SEMESTER</th>
                    <th class="text-center">TOTAL AMOUNT</th>
                    <th class="text-center">TOTAL BENEFICIARIES</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">REMARKS</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($billings as $id => $billing)
                    <tr>
                        <td class="text-center">{{ $id + 1 }}</td>
                        <td class="text-center"><a
                                href="{{ route('billings') . '/' . $billing->reference_no }}">{{ $billing->reference_no }}</a>
                        </td>
                        <td class="text-center"><strong>{{ $billing->ac_year }}</strong></td>
                        <td class="text-center"><strong>{{ $f->format($billing->semester) }}</strong></td>
                        <td class="text-center">{{ $format->format($billing->total_amount) }}</td>
                        <td class="text-center">{{ $billing->total_beneficiaries }}</td>
                        <td class="text-center">
                            <?php
                            if($billing->billing_status==1):?>
                            <span class="badge badge-pill badge-secondary span-size">Open for Billing Uploads</span>
                            <?php
                            elseif ($billing->billing_status==2):?>
                            <span class="badge badge-pill badge-info span-size">Ongoing Validation, please return once
                                done</span>
                            <?php
                            elseif ($billing->billing_status==3):?>
                            <span class="badge badge-pill badge-primary span-size">Done Validating: Ready For
                                Submission</span>
                            <?php
                            elseif ($billing->billing_status==4):?>
                            <span class="badge badge-pill badge-danger span-size">Done Validating: For Review</span>
                            <?php
                            elseif ($billing->billing_status==5):?>
                            <span class="badge badge-pill badge-primary span-size">Finalizing Billing</span>
                             <?php
                            elseif ($billing->billing_status==6):?>
                            <span class="badge badge-pill badge-primary span-size">Submitted to UniFAST: Billing
                                Unit</span>    
                            <?php
                            elseif ($billing->billing_status==7):?>
                            <span class="badge badge-pill badge-danger span-size">For Revision</span>
                            <?php
                            elseif ($billing->billing_status==8):?>
                            <span class="badge badge-pill badge-warning span-size">Submitted to CHED-AFMS</span>
                            <?php
                            elseif ($billing->billing_status==9):?>
                            <span class="badge badge-pill badge-success span-size">Ready for Disbursement</span>
                            <?php
                            elseif ($billing->billing_status==10):?>
                            <span class="badge badge-pill badge-success span-size">Disbursed</span>
                            <?php
                            endif;?>
                        </td>
                        <td></td>
                        <td class="text-center">
                            <?php if ($billing->billing_status == 2 || $billing->billing_status > 5): ?>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a class="btn btn-outline-secondary disabled" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="Edit Grantees" href="#"><i class="far fa-edit"></i></a>
                                    <a class="btn btn-outline-secondary disabled" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="Edit Billing Settings" href="#' }}"><i class="fas fa-sliders"></i></a>
                                </div>
                            <?php elseif ($billing->billing_status === 5): ?>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a class="btn btn-outline-primary" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="Attachments" href="{{ 'billings/' . $billing->reference_no . '/attachments' }}"><i class="far fa-edit"></i></a>
                                </div>
                            <?php else: ?>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a class="btn btn-outline-primary" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="Edit Grantees" href="{{ route('billings') . '/' . $billing->reference_no }}"><i class="far fa-edit"></i></a>
                                    <a class="btn btn-outline-primary" role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom" title="Edit Billing Settings" href="{{ route('billings') . '/' . $billing->reference_no . '/settings' }}"><i class="fas fa-sliders"></i></a>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@else
    <div class="card p-3">
        <div class="row text-center justify-content-center p-3">
            <h3>There are no billings yet.</h3>
        </div>
     </div>
@endif
