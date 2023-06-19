<table class="table table-bordered my-0" id="tbl_form2">
    <thead>
        <tr>
            <th>AWARD NO</th>
            <th>FULL NAME</th>
            <th>COURSE APPLIED</th>
            <th class="text-center">YEAR</th>
            <th class="text-left">REMARKS</th>
            <th class="text-right">AMOUNT</th>
            <th>STATUS</th>
            <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $index => $student)
        <tr>
            <td>{{ $student->fhe_award_no }}</td>
            <td>{{ $student->stud_lname . ' ' . $student->stud_fname . ' ' . $student->stud_mname }}</td>
            <td>{{ $student->degree_program }}</td>
            <td class="text-center">{{ $student->year_level }}</td>
            <td class="text-left">
                @if ($student->remarks == '<span class="badge badge-danger">Duplicate</span>')
                    <span class="badge badge-danger">Duplicate</span>
                @else
                    {{ $student->remarks }}
                @endif
            </td>
            <td class="text-right">{{ $student->total_fee }}</td>
            <td>{{ $student->stud_status }}</td>
            <td class="text-center">
                <button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#modal">View</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>