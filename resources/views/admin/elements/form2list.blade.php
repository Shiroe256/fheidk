<table class="table table-bordered my-0" id="dataTable">
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
        {{$fullName = $student->stud_lname . ' ' . $student->stud_fname . ' ' . $student->stud_mname;}}
        <tr>
            <td>{{$student->app_id}}</td>
            <td>{{$student->fhe_award_no}}</td>
            <td>{{$fullName}}</td>
            <td>Bachelor of Science in Information and Technology</td>
            <td class="text-center">1<br></td>
            <td class="text-left">Valedictorian in High School</td>
            <td class="text-right">43,000.00</td>
            <td><span class="badge badge-pill badge-success billing-status-badge">Enrolled<br></span></td>
            <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#modal">View</button></td>
        </tr>
        @endforeach
    </tbody>
</table>