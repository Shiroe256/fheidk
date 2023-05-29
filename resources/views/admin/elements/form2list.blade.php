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
        @foreach ($billings as $billing)
        <tr>
            <td>{{$billing->students->app_id}}</td>
            <td>{{$billing->students->fhe_award_no}}</td>
            <td>{{$billing->students->stud_lname . ' ' . $student->stud_fname . ' ' . $student->stud_mname}}</td>
            <td>{{$billing->students->degree_program}}</td>
            <td class="text-center">{{$billing->students->year_level}}<br></td>
            <td class="text-left">{{$billing->students->remarks}}</td>
            <td class="text-right">{{$billing->students->total_fees}}</td>
            <td><span class="badge badge-pill badge-success billing-status-badge">{{$billing->students->stud_status}}<br></span></td>
            <td class="text-center"><button class="btn btn-outline-info btn-block btn-sm border rounded-pill" type="button" data-toggle="modal" data-target="#modal">View</button></td>
        </tr>
        @endforeach
    </tbody>
</table>