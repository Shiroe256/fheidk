<table class="table table-bordered my-0" id="tbl_form2">
    <thead>
        <tr>
            <th>AWARD NO</th>
            <th>FULL NAME</th>
            <th>COURSE APPLIED</th>
            <th class="text-center">YEAR</th>
            <th class="text-left">REMARKS</th>
            <th>STATUS</th>
            <th class="text-right">AMOUNT</th>
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
            <td class="text-left">{!! $student->remarks !!}</td>
            <td>
                @if ($student->stud_status == 0)
                    <span class="badge badge-pill badge-success billing-status-badge">Enrolled<br /></span>
                @elseif ($student->stud_status == 1)
                    <span class="badge badge-pill badge-warning billing-status-badge">On-LOA<br /></span>
                @elseif ($student->stud_status == 2)
                    <span class="badge badge-pill badge-danger billing-status-badge">Dropped<br /></span>
                @endif
            </td>
            <td class="text-right">{{ $student->total_fee }}</td>
            <td class="text-center">
                <button id="{{$student->stud_uid}}" class="btn_view_student_info btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#mod_student_info">View</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>TOTAL</th>
            <th>{{ $totalAmount }}</th>
        </tr>
    </tfoot>
</table>