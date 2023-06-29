<table class="table table-bordered my-0" id="tbl_form3">
    <thead>
        <tr>
            <th>APP ID</th>
            <th>FULL NAME</th>
            <th>COURSE APPLIED</th>
            <th class="text-center">YEAR</th>
            <th class="text-left">REMARKS</th>
            <th class="text-center">TOTAL EXAM</th>
            <th class="text-right">AMOUNT</th>
            <th>RESULT</th>
            <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{$student->app_id}}</td>
            <td>{{$student->stud_lname . ', ' . $student->stud_fname . ' ' . $student->stud_mname}}</td>
            <td>{{$student->degree_program}}</td>
            <td>{{ $student->stud_sex }}</td>
            <td>{{ $student->stud_birth_date }}</td>
            <td>{{ $student->stud_phone_no }}</td>
            <td>{{ $student->stud_email }}</td>
            <td class="text-center">{{$student->year_level}}<br></td>
            <td class="text-left">{!! $student->remarks !!}</td>
            <td class="text-center">{{$student->total_exam_taken}}</td>
            <td class="text-right">{{$student->entrance_and_admission_fee}}</td>
            <td>{!! $student->exam_result !!}</td>
            <td class="text-center"><button id="{{$student->stud_uid}}" class="btn_view_applicant_info btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#mod_applicant_info">View</button></td>
        </tr>
        @endforeach
    </tbody>
</table>