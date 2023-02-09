<?php $format = new NumberFormatter('en_PH', NumberFormatter::CURRENCY); //currency formatter ?>
@if ($students->count() > 0)
    <table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_students">
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
                <th class="text-left" title="No need to click this after saving. This is just for viewing purposes"
                    data-placement="bottom">AMOUNT BILLED <i class="fa-solid fa-circle-question"></i></th>
                <th class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody id="tbl_list_of_students_form_2">
            @foreach ($students as $student)
                <?php
                $total_amount = $student->tuition_fee; //temporarily put to tuition fee column
                $student_status = '';
                if ($student->stud_status == 0) {
                    $student_status = 'Enrolled';
                } ?>
                <tr>
                    <td class="text-center"><input type="checkbox" class="chk_student" id="{{ $student->uid }}"
                            name="student_checkbox" value="{{ $student->uid }}"></td>
                    <td class="text-left">{{ $student->hei_name }}</td>
                    <td class="text-left">{{ $student->app_id }}</td>
                    <td class="text-left">{{ $student->fhe_award_no }}</td>
                    <td id="std_lname_{{ $student->uid }}">{{ $student->stud_lname }}</td>
                    <td id="std_fname_{{ $student->uid }}">{{ $student->stud_fname }}</td>
                    <td id="std_mname_{{ $student->uid }}">{{ $student->stud_mname }}</td>
                    <td id="std_course_{{ $student->uid }}">{{ $student->degree_program }}</td>
                    <td id="std_year_{{ $student->uid }}" class="text-center">{{ $student->year_level }}</td>
                    <td class="text-left">{!! $student->remarks !!}</td>
                    <td class="text-left">{{ $student_status }}</td>
                    <td class="text-left">
                        <p data-bs-toggle="tooltip" data-bs-placement="bottom" title="Click to recompute"
                            class="student_fees" id="{{ 'totalfees_' . $student->uid }}">
                            {{ $format->format($student->total_osf + $student->total_tuition + $student->total_nstp + $student->total_lab + $student->total_comp_lab) }}
                        </p>
                    </td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="{{ $student->uid }}" class="btn btn_update_student btn-outline-primary"
                                data-bs-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button"
                                title="Edit Student Information" data-bs-target="#mod_edit_student_info"><i
                                    class="far fa-edit"></i>
                            </button>
                            <button value="{{ $student->uid }}" class="btn btn_stud_settings btn-outline-primary"
                                title="Edit Student Fees" data-placement="bottom" type="button"><i
                                    class="fas fa-wrench"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center py-5">
        <h3 class="text-secondary">There are still no Students in this billing.</h3>
        <h5>Upload a student spreadsheet?</h5>
        <button onclick="document.getElementById('btn_download_template').click()"
            class="btn btn-outline-primary btn-sm"><i class="fas fa-download"></i>&nbsp;Download Template</button>
        <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal"
            data-bs-target="#mod_upload"><i class="fas fa-file-upload"></i>&nbsp;Upload
            List</button>
    </div>
@endif
