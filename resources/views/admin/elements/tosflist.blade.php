<table class="table table-bordered my-0" id="tbl_tosf">
    <thead>
        <tr>
            <th class="text-left">DEGREE PROGRAM</th>
            <th class="text-center">YEAR LEVEL</th>
            <th class="text-center">SEMESTER</th>
            <th class="text-left">TYPE OF FEE</th>
            <th class="text-left">CATEGORY</th>
            <th class="text-left">COVERAGE</th>
            <th class="text-left">REMARKS</th>
            <th class="text-right">AMOUNT</th>
            <th class="text-right">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fees as $fee)
            <tr>
                <td class="text-left">{{ $fee->course_enrolled }}</td>
                <td class="text-center">{{ $fee->year_level }}</td>
                <td class="text-center">{{ $fee->semester }}</td>
                <td class="text-left">{{ $fee->type_of_fee }}</td>
                <td class="text-left">{{ $fee->category }}</td>
                <td class="text-left">{{ $fee->coverage }}</td>
                @if ($fee->is_optional == 0)
                    <td class="text-left"></td>
                @else
                    <td class="text-left">Optional</td>
                @endif
                <td class="text-right">{{ $fee->amount }}</td>
                <td class="text-center">
                    <div role="group" class="btn-group"><button id="btn_edit" class="btn_edit btn btn-primary"
                            type="button"><i class="fas fa-edit"></i></button><button id="btn_remove"
                            class="btn_remove btn btn-danger" type="button"><i class="far fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
