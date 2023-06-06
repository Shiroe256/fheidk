<?php $format = new NumberFormatter('en_PH', NumberFormatter::CURRENCY); //currency formatter
?>
@if($exceptions->count() > 0)
    <table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_exception_report">
    <thead>
        <tr>
            <th class="text-center"><input type="checkbox" name="main_checkbox"></th>
            <th class="text-left">HEI CAMPUS</th>
            <th class="text-left">APP ID</th>
            <th class="text-left">AWARD NUMBER</th>
            <th class="text-left">LASTNAME</th>
            <th class="text-left">FIRSTNAME</th>
            <th class="text-left">MIDDLENAME</th>
            <th>COURSE</th>
            <th class="text-center">YEAR</th>
            <th class="text-left">REMARKS</th>
            <th class="text-left">STATUS</th>
            <th class="text-left">AMOUNT BILLED</th>
            <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody id="tbl_list_of_exceptions">
    @foreach ($exceptions as $exception)
        <?php

        $student_status = '';
        if ($exception->stud_status == 0) {
            $student_status = 'Enrolled';
        } elseif ($exception->stud_status == 1) {
            $student_status = 'On-LOA';
        } elseif ($exception->stud_status == 2) {
            $student_status = 'Dropped';
        } elseif ($exception->stud_status == 3) {
            $student_status = 'Graduated';
        } else {
            $student_status = '';
        }
        ?>
        <tr class="text-danger">
            <td class="text-center"><input type="checkbox" id="{{$exception->uid}}" name="student_checkbox" value="{{$exception->uid}}"></td>
            <td class="text-left">{{$exception->hei_name}}</td>
            <td class="text-left">{{$exception->app_id}}</td>
            <td class="text-left">{{$exception->fhe_award_no}}</td>
            <td>{{$exception->stud_lname}}</td>
            <td>{{$exception->stud_fname}}</td>
            <td>{{$exception->stud_mname}}</td>
            <td>{{$exception->degree_program}}</td>
            <td class="text-center">{{$exception->year_level}}</td>
            <td class="text-left">{!!$exception->remarks!!}</td>
            <td class="text-left">{{$student_status}}</td>
            <td class="text-left">{{$format->format($exception->$total_fees)}}</td>
            <td class="text-center">
                <div class="btn-group btn-group-sm" role="group">
                    <button id="{{$exception->uid}}" class="btn btn_update_student btn-outline-primary" data-bs-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-bs-target="#mod_edit_student_info"><i class="far fa-edit"></i>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
@else
    <h1 class="text-center text-secondary my-5">No exception reports, please run the billing checker again.</h1>
@endif
