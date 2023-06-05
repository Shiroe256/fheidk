{{-- <table class="table table-bordered my-0" id="tbl_form2">
    <thead>
        <tr>
            <th>APP ID</th>
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
        @foreach ($students as $student)
        <tr>
            <td>{{$student->app_id}}</td>
            <td>{{$student->fhe_award_no}}</td>
            <td>{{$student->stud_lname . ' ' . $student->stud_fname . ' ' . $student->stud_mname}}</td>
            <td>{{$student->degree_program}}</td>
            <td class="text-center">{{$student->year_level}}<br></td>
            <td class="text-left">{{$student->remarks}}</td>
            <td class="text-right">{{$student->total_fees}}</td>
            <td><span class="badge badge-pill badge-success billing-status-badge">{{$student->stud_status}}<br></span></td>
            <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#modal">View</button></td>
        </tr>
        @endforeach
    </tbody>
</table> --}}

<table class="table table-bordered my-0" id="tbl_form2">
    <thead>
        <tr>
            <th>TUITION</th>
            <th>ENTRANCE</th>
            <th>ADMISSION</th>
            <th>ATHLETIC</th>
            <th>COMPUTER</th>
            <th>CULTURAL</th>
            <th>DEVELOPMENT</th>
            <th>GUIDANCE</th>
            <th>HANDBOOK</th>
            <th>LABORATORY</th>
            <th>LIBRARY</th>
            <th>MEDICAL AND DENTAL</th>
            <th>REGISTRATION</th>
            <th>SCHOOL ID</th>
            <th>NSTP</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{$student->tuition_fee}}</td>
            <td>{{$student->entrance_fee}}</td>
            <td>{{$student->admission_fee}}</td>
            <td>{{$student->athletic_fee}}</td>
            <td>{{$student->computer_fee}}</td>
            <td>{{$student->cultural_fee}}</td>
            <td>{{$student->development_fee}}</td>
            <td>{{$student->guidance_fee}}</td>
            <td>{{$student->handbook_fee}}</td>
            <td>{{$student->laboratory_fee}}</td>
            <td>{{$student->library_fee}}</td>
            <td>{{$student->medical_dental_fee}}</td>
            <td>{{$student->registration_fee}}</td>
            <td>{{$student->school_id_fee}}</td>
            <td>{{$student->nstp_fee}}</td>
            <td>{{$student->total_fees}}</td>
        </tr>
        @endforeach
    </tbody>
</table>