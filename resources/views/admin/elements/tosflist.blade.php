<table class="table table-bordered my-0" id="tbl_tosf" style="width: 100%">
    <thead>
        <tr>
            <th class="text-center" rowspan="2"><input name="main_tosf_checkbox" type="checkbox" data-toggle="tooltip" title="Select All" /></th>
            <th class="text-left">DEGREE PROGRAM</th>
            <th class="text-center">YEAR LEVEL</th>
            <th class="text-center">SEMESTER</th>
            <th class="text-left">TYPE OF FEE</th>
            <th class="text-left">CATEGORY</th>
            <th class="text-left">COVERAGE</th>
            <th class="text-right" rowspan="2">AMOUNT</th>
            <th class="text-right" rowspan="2">ACTION</th>
        </tr>
        <tr>
            <th class="text-center col_search" id="search_degree_program"></th>
            <th class="text-center" id="search_year_level"></th>
            <th class="text-center" id="search_semester"></th>
            <th class="text-left" id="search_type_of_fee"></th>
            <th class="text-left" id="search_category"></th>
            <th class="text-left" id="search_coverage"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fees as $fee)
            <tr>
                <td class="text-center"><input id="{{ $fee->uid }}" name="tosf_checkbox" type="checkbox" data-toggle="tooltip" title="Select" value="{{ $fee->uid }}" /></td>
                <td class="text-left">{{ $fee->course_enrolled }}</td>
                <td class="text-center">{{ $fee->year_level }}</td>
                <td class="text-center">{{ $fee->semester }}</td>
                <td class="text-left">{{ $fee->type_of_fee }}</td>
                <td class="text-left">{{ $fee->category }}</td>
                <td class="text-left">{{ $fee->coverage }}</td>
                <td class="text-right">{{ $fee->amount }}</td>
                <td class="text-center">
                    <button id="{{ $fee->uid }}" class="btn_update_fee btn_edit btn btn-info" type="button" data-toggle="modal" data-target="#modal_update_tosf" title="Edit Fee"><i class="fas fa-pen"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
