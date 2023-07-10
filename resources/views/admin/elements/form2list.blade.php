<table class="table table-bordered my-0" id="tbl_form2">
    <thead>
        <tr>
            <th>AWARD NO</th>
            <th>FULL NAME</th>
            <th>COURSE APPLIED</th>
            <th>SEX</th>
            <th>BIRTH DATE</th>
            <th>PHONE</th>
            <th>EMAIL</th>
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
            <td>{{ $student->stud_lname . ', ' . $student->stud_fname . ' ' . $student->stud_mname }}</td>
            <td>{{ $student->degree_program }}</td>
            <td>{{ $student->stud_sex }}</td>
            <td>{{ $student->stud_birth_date }}</td>
            <td>{{ $student->stud_phone_no }}</td>
            <td>{{ $student->stud_email }}</td>
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
            <td class="text-right">{{ number_format(doubleval($student->total_fee), 2, '.', ',') }}</td>
            <td class="text-center">
                <button id="{{$student->stud_uid}}" class="btn_view_student_info btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#mod_student_info">View</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th class="font-weight-bold h5" colspan="9">TOTAL</th>
            <th class="text-center text-danger font-weight-bold h5" colspan="3">{{ number_format(doubleval($totalAmount), 2, '.', ',') }}</th>
        </tr>
    </tfoot>
</table>