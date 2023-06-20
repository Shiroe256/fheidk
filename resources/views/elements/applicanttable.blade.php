<?php $format = new NumberFormatter('en_PH', NumberFormatter::CURRENCY); //currency formatter ?>
@if ($applicants->count() > 0)
    <table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_applicants">
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox"></th>
                <th class="text-left">HEI CAMPUS</th>
                <th class="text-left">APP ID</th>
                <th class="text-left">LASTNAME</th>
                <th class="text-left">FIRSTNAME</th>
                <th class="text-left">MIDDLENAME</th>
                <th>COURSE</th>
                <th class="text-center">YEAR</th>
                <th class="text-left">REMARKS</th>
                <th class="text-center">NO. OF EXAM TAKEN</th>
                <th class="text-left">RESULT</th>
                <th class="text-left">TOTAL EXAM FEES</th>
                <th class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody id="tbl_list_of_students_form_3">
            <?php
        foreach ($applicants as $applicant): 
             ?>
            <tr>
                <td class="text-center"><input type="checkbox" id="{{ $applicant->uid }}" name="applicant_checkbox"
                        value="{{ $applicant->uid }}"></td>
                <td class="text-left">{{ $applicant->hei_name }}</td>
                <td class="text-left">{{ $applicant->app_id }}</td>
                <td>{{ $applicant->stud_lname }}</td>
                <td>{{ $applicant->stud_fname }}</td>
                <td>{{ $applicant->stud_mname }}</td>
                <td>{{ $applicant->degree_program }}</td>
                <td class="text-center">{{ $applicant->year_level }}</td>
                <td class="text-left">{{ $applicant->transferee }}</td>
                <td class="text-center">{{ $applicant->total_exam_taken }}</td>
                <td class="text-left"><span class="badge badge-{{$applicant->exam_result=='Passed'?'success':'danger'}}">{{ $applicant->exam_result }}</span><br></td>
                <td class="text-left">{{ $applicant->exam_fees }}<br></td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm" role="group">
                        <button id="{{ $applicant->uid }}" class="btn btn_update_student btn-outline-primary"
                            data-bs-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button"
                            title="Edit Applicant Information" data-bs-target="#mod_admission_entrance"><i
                                class="far fa-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <?php
        endforeach;
        ?>
        </tbody>
    </table>
@else
    <div class="text-center py-5">
        <h3 class="text-secondary">There are still no Students in this billing.</h3>
        <h5>Upload a student spreadsheet?</h5>
        <button onclick="document.getElementById('btn_download_template').click()"
            class="btn btn-outline-primary btn-sm"><i class="fas fa-download"></i>&nbsp;Download Template</button>
        <button onclick="document.getElementById('btn_upload').click()" class="btn btn-outline-primary btn-sm"
            type="button"><i class="fas fa-file-upload"></i>&nbsp;Upload
            List</button>
    </div>
@endif
