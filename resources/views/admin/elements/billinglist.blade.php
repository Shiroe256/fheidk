<table class="table table-bordered my-0" id="tbl_manage_billing_list" style="width: 100%">
    <thead>
        <tr>
            <th class="text-center">ACADEMIC YEAR</th>
            <th class="text-center">SEMESTER</th>
            <th>REGION</th>
            <th>HEI NAME</th>
            <th>REFERENCE NO.</th>
            <th class="text-right" rowspan="2">BENEFICIARIES</th>
            <th class="text-right" rowspan="2">AMOUNT</th>
            <th rowspan="2">STATUS</th>
            <th class="text-center" rowspan="2">ACTION</th>
        </tr>
        <tr>
            <th id="search_billing_list_academic_year"></th>
            <th id="search_billing_list_semester"></th>
            <th id="search_billing_list_region"></th>
            <th id="search_billing_list_hei_name"></th>
            <th id="search_billing_list_reference_no"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($billings as $billing)
            <tr>
                <td class="text-center">{{ $billing->ac_year }}</td>
                <td class="text-center">{{ $billing->semester }}</td>
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
                    <a href="{{ route('managebillingpage', $billing->reference_no) }}" id="{{ $billing->uid }}"
                        name="btn_view_billing" class="btn btn-primary" role="button" title="View"><i class="fas fa-eye"></i>View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>