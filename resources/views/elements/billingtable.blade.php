<?php $f = new NumberFormatter('en', NumberFormatter::ORDINAL); ?>
<?php $format = new NumberFormatter('en_PH', NumberFormatter::CURRENCY); ?>
@if (count($billings) > 0)
    <div class="table-responsive mt-2">
        <table class="table table-hover" id="tbl_listofbillings">
            <thead>
                <tr>
                    <th class="text-center">NO.</th>
                    <th class="text-center">REFERENCE NO.</th>
                    <th class="text-center">ACADEMIC YEAR</th>
                    <th class="text-center">SEMESTER</th>
                    {{-- <th class="text-center">TOTAL AMOUNT</th> --}}
                    <th class="text-center">TOTAL BENEFICIARIES</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">REMARKS</th>
                    <th class="text-center">TO DO</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($billings as $id => $billing)
                    <tr>
                        <td class="text-center">{{ $id + 1 }}</td>
                        @if ($billing->billing_status == 2 || ($billing->billing_status > 5 && $billing->billing_status != 7))
                            <td class="text-center"><span
                                    class="badge badge-pill badge-primary">{{ $billing->reference_no }}</span>
                            </td>
                        @else
                            <td class="text-center"><span class="badge badge-pill badge-primary"><a class="text-light"
                                        href="{{ route('billings') . '/' . $billing->reference_no }}">{{ $billing->reference_no }}</a></span>
                            </td>
                        @endif
                        <td class="text-center"><strong>{{ $billing->ac_year }}</strong></td>
                        <td class="text-center"><strong>{{ $f->format($billing->semester) }}</strong></td>
                        {{-- <td class="text-center">{{ $format->format($billing->total_fee) }}</td> --}}
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
                            <?php
                            if($billing->billing_status==1):?>
                            <p>Download billing template</p> <p>Upload the filled out billing template</p> <p>Click the <b>Run validation</b> button</p>
                            <?php
                            elseif ($billing->billing_status==2):?>
                            <p>Refresh the page to check if the validation is done</p>
                            <?php
                            elseif ($billing->billing_status==3):?>
                            <p>The billing is ready for submission. However, the HEI can still add, edit or remove student in the billing</p>
                            <?php
                            elseif ($billing->billing_status==4):?>
                            <p>Refer to the exceptions generated by the system, remove the duplicate entries and student who exceeded the program's Maximum Residency Rule (MRR)</p><p>After removing, click the <b>Run validation</b> button </p>
                            <?php
                            elseif ($billing->billing_status==5):?>
                            <p>Download, print and sign the Billing Form 1, 2 and 3</p> <p>Upload the signed forms and other attachments to your google drive</p><p>Attach the links from the google drive</p><p>Click <b>"Submit for Review"</b> button</p>
                            <?php
                            elseif ($billing->billing_status==6):?>
                            <p>UniFAST Billing Unit will review your submission</p><p>You can view the status and content of the submitted billing but, you will not be able to edit its content</p>
                            <?php
                            elseif ($billing->billing_status==7):?>
                            <p>Refer to the remarks and apply necessary changes to the billing</p><p>Click the <b>"Run Validation"</b> button</p>
                            <?php
                            elseif ($billing->billing_status==8):?>
                            <p>CHED AFMS Unit will review your submission</p><p>You can view the status and content of the submitted billing but, you will not be able to edit its content</p>
                            <?php
                            elseif ($billing->billing_status==9):?>
                            <p>CHED AFMS will process the billing for disbursement</p><p>You can view the status and content of the submitted billing but, you will not be able to edit its content</p>
                            <?php
                            elseif ($billing->billing_status==10):?>
                            <p>Disbursed</p><p>You can view the status and content of the submitted billing but, you will not be able to edit its content</p>
                            <?php
                            endif;?>
                        </td>
                        <td class="text-center">
                            <?php if ($billing->billing_status == 2 || ($billing->billing_status > 5 && $billing->billing_status != 7)): ?>
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-secondary disabled" role="button" data-toggle="tooltip"
                                    data-bs-tooltip="" data-placement="bottom" title="Edit Grantees" href="#"><i
                                        class="far fa-edit"></i></a>
                                <a class="btn btn-secondary disabled" role="button" data-toggle="tooltip"
                                    data-bs-tooltip="" data-placement="bottom" title="Edit Billing Settings"
                                    href="#' }}"><i class="fas fa-sliders"></i></a>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" aria-expanded="false"
                                        data-bs-toggle="dropdown" type="button">
                                        <i class="far fa-file-pdf"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right animated--fade-in">
                                        <h6 class="dropdown-header">SELECT FORM TO DOWNLOAD:</h6>
                                        <a class="dropdown-item"
                                            href="{{ Request::url() . '/' . $billing->reference_no . '/attachments/form1' }}"
                                            target="_blank"><i
                                                class="fas fa-file-download fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Form 1 (Billing Summary)</a>
                                        <a class="dropdown-item"
                                            href="{{ Request::url() . '/' . $billing->reference_no . '/attachments/form2' }}"
                                            target="_blank"><i
                                                class="fas fa-file-download fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Form 2 (Billing Details)</a>
                                        <a class="dropdown-item"
                                            href="{{ Request::url() . '/' . $billing->reference_no . '/attachments/form3' }}"
                                            target="_blank"><i
                                                class="fas fa-file-download fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Form 3 (Billing Details)</a>
                                    </div>
                                </div>
                            </div>
                            <?php elseif ($billing->billing_status === 5 || $billing->billing_status === 7): ?>
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-primary" role="button" data-toggle="tooltip" data-bs-tooltip=""
                                    data-placement="bottom" title="Attachments"
                                    href="{{ 'billings/' . $billing->reference_no . '/attachments' }}"><i
                                        class="far fa-file-alt"></i></a>
                            </div>
                            <?php else: ?>
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-primary" role="button" data-toggle="tooltip" data-bs-tooltip=""
                                    data-placement="bottom" title="Edit Grantees"
                                    href="{{ route('billings') . '/' . $billing->reference_no }}"><i
                                        class="far fa-edit"></i></a>
                                <a class="btn btn-primary" role="button" data-toggle="tooltip" data-bs-tooltip=""
                                    data-placement="bottom" title="Edit Billing Settings"
                                    href="{{ route('billings') . '/' . $billing->reference_no . '/settings' }}"><i
                                        class="fas fa-sliders"></i></a>
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
