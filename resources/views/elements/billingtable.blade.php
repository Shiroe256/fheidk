<div class="table-responsive table mt-2 table-style" role="grid" aria-describedby="dataTable_info">
    <table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_listofbillings">
        <thead>
            <tr>
                <th class="text-center">NO.</th>
                <th class="text-center">REFERENCE NO.</th>
                <th class="text-center">ACADEMIC YEAR</th>
                <th class="text-center">SEMESTER</th>
                <th class="text-center">TRANCHE</th>
                <th class="text-center">TOTAL AMOUNT</th>
                <th class="text-center">TOTAL BENEFICIARIES</th>
                <th class="text-center">STATUS</th>
                <th class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($billings as $id => $billing)
                <tr>
                    <td class="text-center">{{ $id + 1 }}</td>
                    <td class="text-center">{{ $billing['reference_no'] }}</td>
                    <td class="text-center"><strong>{{ $billing['ac_year'] }}</strong></td>
                    <td class="text-center"><strong>{{ $billing['semester'] }}</strong></td>
                    <td class="text-center">{{ $billing['tranche'] }}</td>
                    <td class="text-center">{{ $billing['total_amount'] }}</td>
                    <td class="text-center">{{ $billing['total_beneficiaries'] }}</td>
                    <td class="text-center"><span class="badge badge-pill badge-primary span-size">Submitted</span></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group"><a class="btn btn-outline-info"
                                role="button" data-toggle="tooltip" data-bs-tooltip="" data-placement="bottom"
                                title="Edit" href="{{ route('billings') . '/' . $billing['reference_no'] }}"><i
                                    class="far fa-eye"></i></a>
                            <a class="btn btn-outline-warning" role="button" data-toggle="tooltip" data-bs-tooltip=""
                                data-placement="bottom" title="Edit"
                                href="{{ route('billings') . '/' . $billing['reference_no'] . '/settings' }}"><i
                                    class="fas fa-sliders"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            {{-- sample shit --}}

        </tbody>
        <tfoot>
            <tr></tr>
        </tfoot>
    </table>
</div>
