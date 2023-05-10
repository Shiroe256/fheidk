<table class="table table-bordered my-0" id="tbl_manage_billing_list">
    <thead>
        <tr>
            <th>REGION</th>
            <th>HEI NAME</th>
            <th>REFERENCE NO.</th>
            <th class="text-right">BENEFICIARIES</th>
            <th class="text-right">AMOUNT</th>
            <th>STATUS</th>
            <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($billings as $billing)
            <tr>
                <td>{{ $billing->hei->hei_region_nir }}</td>
                <td>{{ $billing->hei->hei_name }}</td>
                <td>{{ $billing->reference_no }}</td>
                <td class="text-right">{{ $billing->total_beneficiaries }}</td>
                <td class="text-right">{{ $billing->total_amount }}</td>
                <td>
                    @if ($billing->billing_status == 1)
                        <span class="badge badge-pill badge-secondary span-size">Open for Billing Uploads</span>
                    @elseif ($billing->billing_status == 2)
                        <span class="badge badge-pill badge-info span-size">Ongoing Validation, please return once
                            done</span>
                    @elseif ($billing->billing_status == 3)
                        <span class="badge badge-pill badge-primary span-size">Done Validating: Ready For
                            Submission</span>
                    @elseif ($billing->billing_status == 4)
                        <span class="badge badge-pill badge-danger span-size">Done Validating: For Review</span>
                    @elseif ($billing->billing_status == 5)
                        <span class="badge badge-pill badge-warning span-size">Submitted to UniFAST: Billing Unit</span>
                    @elseif ($billing->billing_status == 6)
                        <span class="badge badge-pill badge-warning span-size">Submitted to UniFAST: Admin Unit</span>
                    @elseif ($billing->billing_status == 7)
                        <span class="badge badge-pill badge-warning span-size">Submitted to CHED-AFMS</span>
                    @elseif ($billing->billing_status == 8)
                        <span class="badge badge-pill badge-success span-size">Disbursed</span>
                    @endif
                </td>
                <td>
                    <a href="'{{ route('managebillingpage', $billing->reference_no) }}" id="{{ $billing->uid }}"
                        name="btn_view_billing" class="btn btn-outline-info btn-block btn-sm border rounded-pill"
                        role="button"><i class="fas fa-eye"></i>View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td><strong>REGION</strong><br></td>
            <td><strong>HEI NAME</strong><br></td>
            <td><strong>REFERENCE NO.</strong><br></td>
            <td class="text-right"><strong>BENEFICIARIES</strong></td>
            <td class="text-right"><strong>AMOUNT</strong></td>
            <td><strong>STATUS</strong></td>
            <td class="text-center"><strong>ACTION</strong></td>
        </tr>
    </tfoot>
</table>