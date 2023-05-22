<table class="table table-bordered my-0" id="dataTable">
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
            <td>{{$student->stud_lname . ' ' . $student->stud_fname . ' ' . $student->stud_mname}}</td>
            <td>{{$student->degree_program}}</td>
            <td class="text-center">{{$student->year_level}}<br></td>
            <td class="text-left">{{$student->remarks}}</td>
            <td class="text-center">{{$student->total_exam_taken}}</td>
            <td class="text-right">{{$student->total_fees}}</td>
            <td><span class="badge badge-pill badge-danger billing-status-badge">{{$student->exam_result}}<br></span></td>
            <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#modal_2">View</button></td>
        </tr>
        @endforeach
    </tbody>
</table>