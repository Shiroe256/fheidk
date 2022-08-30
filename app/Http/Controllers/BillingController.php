<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\OtherSchoolFees;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\TemporaryBilling;
use App\Models\TuitionFees;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    private function generateBillingReferenceNumber($hei_psg_region, $hei_sid, $ac_year, $semester, $tranche)
    {
        $reference_number = $hei_psg_region . "-" . $hei_sid . "-" . $ac_year . "-" . $semester . "-" . $tranche;
        return $reference_number;
    }

    public function fetchTempStudent()
    {
        $students = TemporaryBilling::all();
        $output = '';
        if ($students->count() > 0) {
            $output .= '<table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_students">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" name="main_checkbox"></th>
                    <th class="text-left">HEI CAMPUS</th>
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
            <tbody id="tbl_list_of_students_form_2">';
            foreach ($students as $student) {
                $output .= '<tr>
                    <td class="text-center"><input type="checkbox" id="' . $student->uid . '" name="student_checkbox" value="' . $student->uid . '"></td>
                    <td class="text-left">' . $student->hei_name . '</td>
                    <td class="text-left">' . $student->fhe_award_no . '</td>
                    <td>' . $student->stud_lname . '</td>
                    <td>' . $student->stud_fname . '</td>
                    <td>' . $student->stud_mname . '</td>
                    <td>' . $student->degree_program . '</td>
                    <td class="text-center">' . $student->year_level . '</td>
                    <td class="text-left">' . $student->remarks . '</td>
                    <td class="text-left">' . $student->stud_status . '</td>
                    <td class="text-left"></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="' . $student->uid . '" class="btn btn_update_student btn-outline-info" data-bs-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-bs-target="#mod_edit_student_info"><i class="far fa-edit"></i>
                            </button>
                        </div>
                    </td>
                </tr>';
            }
            $output .= '</tbody>
            </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No student records.</h1>';
        }
    }

    // handle insert a new student ajax request
    public function newTempStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required', //modal field name => validation
            'first_name' => 'required',
            'birthplace' => 'required',
            'present_province' => 'required',
            'present_city' => 'required',
            'present_barangay' => 'required',
            'present_zipcode' => 'required',
            'permanent_province' => 'required',
            'permanent_city' => 'required',
            'permanent_barangay' => 'required',
            'permanent_zipcode' => 'required',
            'email_address' => 'required|email',
            'mobile_number' => 'required|regex:/^(09)\d{9}$/',
            'course_enrolled' => 'required',
            'year_level' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $students = [
                //static sample data
                'hei_psg_region' => '01',
                'hei_sid' => '01040',
                'hei_uii' => '01040',
                'hei_name' => 'Mariano Marcos State University',
                'reference_no' => '01-MMMSU-2020-1-1',
                'ac_year' => '2020',
                'semester' => '1',
                'tranche' => '1',
                'app_id' => '01040-20222227-00003',
                'fhe_award_no' => 'FHE-01-01040-20222207-00003',
                'stud_id' => '',
                'lrn_no' => '',
                //actual data being collected in the modal
                'stud_lname' => $request->last_name, //tablename => $request->name of input field
                'stud_fname' => $request->first_name,
                'stud_mname' => $request->middle_name,
                'stud_ext_name' => $request->extension_name,
                'stud_sex' => $request->sex,
                'stud_birth_date' => $request->birthdate,
                'stud_birth_place' => $request->birthplace,
                'f_lname' => $request->f_lname,
                'f_fname' => $request->f_fname,
                'f_mname' => $request->f_mname,
                'm_lname' => $request->m_lname,
                'm_fname' => $request->m_fname,
                'm_mname' => $request->m_mname,
                'present_prov' => $request->present_province,
                'present_city' => $request->present_city,
                'present_barangay' => $request->present_barangay,
                'present_street' => $request->present_street,
                'present_zipcode' => $request->present_zipcode,
                'permanent_prov' => $request->permanent_province,
                'permanent_city' => $request->permanent_city,
                'permanent_barangay' => $request->permanent_barangay,
                'permanent_street' => $request->permanent_street,
                'permanent_zipcode' => $request->permanent_zipcode,
                'stud_email' => $request->email_address,
                'stud_alt_email' => $request->alt_email_address,
                'stud_phone_no' => $request->mobile_number,
                'stud_alt_phone_no' => $request->alt_mobile_number,
                //static
                'trasferee' => '',
                'degree_program' => $request->degree_program,
                'year_level' => $request->year_level,
                'lab_unit' => '1',
                'comp_lab_unit' => '1',
                'academic_unit' => $request->total_unit,
                'nstp_unit' => $request->nstp_unit,
                'tuition_fee' => $request->total_tuition,
                'entrance_fee' => $request->entrance_fee,
                'admission_fee' => $request->admission_fee,
                'athletic_fee' => $request->athletic_fee,
                'computer_fee' => $request->computer_fee,
                'cultural_fee' => $request->cultural_fee,
                'development_fee' => $request->development_fee,
                'guidance_fee' => $request->guidance_fee,
                'handbook_fee' => $request->handbook_fee,
                'laboratory_fee' => $request->laboratory_fee,
                'library_fee' => $request->library_fee,
                'medical_dental_fee' => $request->medical_dental_fee,
                'registration_fee' => $request->registration_fee,
                'school_id_fee' => $request->school_id_fee,
                'nstp_fee' => $request->total_nstp,
                'stud_cor' => 'sample',
                'remarks' => $request->remarks
            ];
            TemporaryBilling::create($students);
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    // find the tosf of the students
    public function findTuitionFee(Request $request)
    {
        $course_enrolled = $request->course_enrolled;
        $total_unit = $request->total_unit;
        $year_level = $request->year_level;
        $tuitionFee = TuitionFees::select(DB::raw('tuition_per_unit * ' . $total_unit . ' AS total_tuition'))
            ->where(trim('course_enrolled'), trim($course_enrolled))
            ->where('year_level', 'like', '%' . $year_level . '%')
            ->value('total_tuition');
        return response()->json($tuitionFee);
    }

    public function findOtherSchoolFees(Request $request)
    {
        $course_enrolled = $request->course_enrolled;
        $otherSchoolFees = OtherSchoolFees::select(DB::raw('type_of_fee, SUM(amount) as total_amount'))
            ->where(trim('course_enrolled'), trim($course_enrolled))
            ->groupby('type_of_fee', 'course_enrolled')
            ->get();
        return response()->json($otherSchoolFees);
    }

    // find the tosf of the students
    public function findNSTPFee(Request $request)
    {
        $course_enrolled = $request->course_enrolled;
        $nstp_unit = $request->nstp_unit;
        $year_level = $request->year_level;
        $nstpFee = TuitionFees::select(DB::raw('nstp_cost_per_unit * ' . $nstp_unit . ' AS total_nstp'))
            ->where(trim('course_enrolled'), trim($course_enrolled))
            ->where('year_level', 'like', '%' . $year_level . '%')
            ->value('total_nstp');
        return response()->json($nstpFee);
    }

    // select degree programs from the database
    public function selectDegreePrograms(Request $request)
    {
        $selectDegreePrograms = OtherSchoolFees::select('course_enrolled')
            ->groupby('course_enrolled')
            ->get();
        return response()->json($selectDegreePrograms);
    }

    // handle edit an student ajax request
    public function editTempStudent(Request $request)
    {
        $id = $request->uid;
        $students = TemporaryBilling::find($id);
        return response()->json($students);
    }

    // handle update an student ajax request
    public function updateTempStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit_last_name' => 'required', //modal field name => validation
            'edit_first_name' => 'required',
            'edit_birthplace' => 'required',
            'edit_present_province' => 'required',
            'edit_present_city' => 'required',
            'edit_present_barangay' => 'required',
            'edit_present_zipcode' => 'required',
            'edit_permanent_province' => 'required',
            'edit_permanent_city' => 'required',
            'edit_permanent_barangay' => 'required',
            'edit_permanent_zipcode' => 'required',
            'edit_email_address' => 'required|email',
            'edit_mobile_number' => 'required|regex:/^(09)\d{9}$/',
            'edit_course_enrolled' => 'required',
            'edit_year_level' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $students = TemporaryBilling::find($request->edit_student_id);
            $studData = [
                //actual data being collected in the modal
                'stud_lname' => $request->edit_last_name, //tablename => $request->name of input field
                'stud_fname' => $request->edit_first_name,
                'stud_mname' => $request->edit_middle_name,
                'stud_ext_name' => $request->edit_extension_name,
                'stud_sex' => $request->edit_sex,
                'stud_birth_date' => $request->edit_birthdate,
                'stud_birth_place' => $request->edit_birthplace,
                'f_lname' => $request->edit_f_lname,
                'f_fname' => $request->edit_f_fname,
                'f_mname' => $request->edit_f_mname,
                'm_lname' => $request->edit_m_lname,
                'm_fname' => $request->edit_m_fname,
                'm_mname' => $request->edit_m_mname,
                'present_prov' => $request->edit_present_province,
                'present_city' => $request->edit_present_city,
                'present_barangay' => $request->edit_present_barangay,
                'present_street' => $request->edit_present_street,
                'present_zipcode' => $request->edit_present_zipcode,
                'permanent_prov' => $request->edit_permanent_province,
                'permanent_city' => $request->edit_permanent_city,
                'permanent_barangay' => $request->edit_permanent_barangay,
                'permanent_street' => $request->edit_permanent_street,
                'permanent_zipcode' => $request->edit_permanent_zipcode,
                'stud_email' => $request->edit_email_address,
                'stud_alt_email' => $request->edit_alt_email_address,
                'stud_phone_no' => $request->edit_mobile_number,
                'alt_stud_phone_no' => $request->edit_alt_mobile_number,
                'degree_program' => $request->edit_course_enrolled,
                'year_level' => $request->edit_year_level
            ];
            $students->update($studData);
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    //handles delete student information
    public function deleteTempStudent(Request $request)
    {
        $id = $request->uid;
        // $students = TemporaryBilling::find($id);
        $students = TemporaryBilling::whereIn('uid', $id);
        $students->delete();
    }

    public function newBilling(Request $request)
    {
        $hei_uii = "11040";
        $hei_sid = "11040"; //bullshit data lang muna
        $hei_psg_region = 1; //bullshit data lang muna
        $tranche = 1; //bullshit data lang muna
        $total_beneficaries = 1; //bullshit data lang muna
        $total_amount = 1;
        $billing_status = 1;
        $created_by = 1;
        $billing = [
            'ac_year' => $request->ac_year,
            'semester' => $request->semester,
            'hei_uii' => $hei_uii,
            'hei_sid' => $hei_sid,
            'hei_psg_region' => $hei_psg_region,
            'tranche' => $tranche,
            'total_beneficiaries' => $total_beneficaries,
            'total_amount' =>         $total_amount,
            'billing_status' =>         $billing_status,
            'created_by' =>         $created_by,
            'reference_no' => $this->generateBillingReferenceNumber(1, $hei_sid, $request->ac_year, $request->semester, 1)
        ];
        $reference_no = Billing::create($billing)->reference_no;

        // echo $reference_no;
        $this->newBillingSettings($reference_no);
    }

    private function newBillingSettings($ref_no)
    {
        $hei_uii = "01040";
        $otherfees = OtherSchoolFees::where('hei_uii', $hei_uii)
            ->selectRaw('uid')
            ->get();
        foreach ($otherfees as $row) {
            //store the shit
            $uid[] = $row->uid;
        }
        $this->upsertSettings($ref_no, $uid);

        echo "/billings/" . $ref_no . "/settings";
    }
    public function billingList()
    {
        $data['billings'] = Billing::all();
        return view('listofbillings', $data);
    }

    public function billingmanagement($ref_no)
    {
        $billings = Billing::where('reference_no', $ref_no)->first();
        if ($billings) {
            return view('billingmanagement');
        }
        abort(404);
    }


    public function getBillingSettings($ref_no)
    {
        $hei_uii = "01040";

        //gather all the categories for everybody in the world
        $otherfees = OtherSchoolFees::join('tbl_billing_settings', 'tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
            ->where('hei_uii', $hei_uii)
            ->where('bs_reference_no', $ref_no)
            ->selectRaw('uid,amount,course_enrolled,type_of_fee,category,year_level,bs_status,updated_at')
            // ->orderBy('updated_at')
            ->get();
        // ->groupBy('course_enrolled', 'type_of_fee', 'category', 'year_level')
        //declare an array to store the shit
        // $otherfeesresult = array();
        $course_lastupdated = array();
        foreach ($otherfees as $key => $row) {
            if (!array_key_exists($row->course_enrolled,$course_lastupdated)) {
                $course_lastupdated[$row->course_enrolled] = $row->updated_at;
            }
            //store the shit
            $otherfeesresult[$row->course_enrolled][$row->year_level][$row->type_of_fee][] = array('category' => $row->category, 'id' => $row->uid, 'amount' => $row->amount, 'bs_status' => $row->bs_status);
            if ($course_lastupdated[$row->course_enrolled] < $row->updated_at) {
                $course_lastupdated[$row->course_enrolled] = $row->updated_at;
            }
        }

        //package the shit and put it out of a view
        $data['course_lastupdated'] = $course_lastupdated;
        $data['otherfees'] = $otherfeesresult;
        $data['ref_no'] = $ref_no;
        return view('billingsettings', $data);
    }

    public function saveSettings(Request $request)
    {
        $onsettings = $request->on;
        $offsettings = $request->off;
        $bs_reference_no = $request->reference_no;
        $this->upsertSettings($bs_reference_no, $onsettings, $offsettings);
        echo $bs_reference_no;
    }

    private function upsertSettings($bs_reference_no, $onsettings = array(), $offsettings = array())
    {
        //on
        $ons = array();
        $bs_status = 1;
        if ($onsettings) {
            foreach ($onsettings as $osf_uid) {
                $ons[] = array('bs_reference_no' => $bs_reference_no, 'bs_osf_uid' => $osf_uid, 'bs_status' => $bs_status);
            }
        }
        Settings::upsert($ons, ['bs_reference_no', 'bs_osf_uid'], ['bs_status']);
        //off
        $offs = array();
        $bs_status = 0;
        if ($offsettings) {
            foreach ($offsettings as $osf_uid) {
                $offs[] = array('bs_reference_no' => $bs_reference_no, 'bs_osf_uid' => $osf_uid, 'bs_status' => $bs_status);
            }
        }
        Settings::upsert($offs, ['bs_reference_no', 'bs_osf_uid'], ['bs_status']);
    }
    //batch upload controller
    public function batchTempStudent(Request $request)
    {
        $tempstudents =  json_decode($request->getContent(), true); //json decode into array (the second parameter)

        //pass validation to each item then return an error and cancel the whole uploading if there are errors
        foreach ($tempstudents as $tempstudent) {
            if ($this->validateTempStudentFields($tempstudent) == FALSE) return response('Error', 400);
        }
        //upload all rows if there is no problem
        foreach ($tempstudents as $tempstudent) {
            $this->newTempStudentBatch($tempstudent);
        }
        return response('Success', 200);
    }

    private function validateTempStudentFields($tempstudent)
    {
        $validator = Validator::make((array) $tempstudent, [
            'last_name' => 'required|max:255',
            'given_name' => 'required|max:255',
            'sex_at_birth' => 'required|max:25',
            'birthdate' => 'required|date_format:Y-m-d',
            'birthplace' => 'required|max:255',
            'mothers_gname' => 'required|max:255', //mother madien fname
            'mothers_lname' => 'required|max:255', //mother madien lname
            'pres_prov' => 'required|max:255',
            'pres_city' => 'required|max:255',
            'pres_brgy' => 'required|max:255',
            'pres_zip' => 'required|max:255',
            'perm_prov' => 'required|max:255',
            'perm_city' => 'required|max:255',
            'perm_brgy' => 'required|max:255',
            'perm_zip' => 'required|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|regex:/^(9)\d{9}$/'
            // 'degree_program' => 'required|max:255'
        ]);

        //return validator failure status
        return $validator->fails();
    }

    private function newTempStudentBatch($data = array())
    {
        $tempstudent = new TemporaryBilling;
        $tempstudent->fhe_award_no = $data['fhe_aw_no'];
        $tempstudent->stud_id = $data['stud_no'];
        $tempstudent->lrn_no = $data['lrnum'];
        $tempstudent->stud_lname = $data['last_name'];
        $tempstudent->stud_fname = $data['given_name'];
        $tempstudent->stud_mname = $data['mid_name'];
        $tempstudent->stud_ext_name = $data['ext_name'];
        $tempstudent->stud_sex = $data['sex_at_birth'];
        $d = new DateTime(str_replace("/", "-", $tempstudent->birthdate));
        $tempstudent->stud_birth_date = $d->format("Y-m-d");
        $tempstudent->stud_birth_place = $data['birthplace'];
        $tempstudent->f_lname = $data['fathers_lname'];
        $tempstudent->f_fname = $data['fathers_gname'];
        $tempstudent->f_mname = $data['fathers_mname'];
        $tempstudent->m_lname = $data['mothers_lname'];
        $tempstudent->m_fname = $data['mothers_gname'];
        $tempstudent->m_mname = $data['mothers_mname'];
        $tempstudent->permanent_prov = $data['perm_prov'];
        $tempstudent->permanent_city = $data['perm_city'];
        $tempstudent->permanent_barangay = $data['perm_brgy'];
        $tempstudent->permanent_street = $data['perm_street'];
        $tempstudent->permanent_zipcode = $data['perm_zip'];
        $tempstudent->present_prov = $data['pres_prov'];
        $tempstudent->present_city = $data['pres_city'];
        $tempstudent->present_barangay = $data['pres_brgy'];
        $tempstudent->present_street = $data['pres_street'];
        $tempstudent->present_zipcode = $data['pres_zip'];
        $tempstudent->stud_email = $data['email'];
        $tempstudent->stud_alt_email = $data['a_email'];
        $tempstudent->stud_phone_no = $data['contact_number'];
        $tempstudent->stud_alt_phone_no = $data['contact_number_2'];
        $tempstudent->transferee = $data['is_transferee'];

        //dummy data
        $tempstudent->degree_program = 69;
        $tempstudent->lab_unit = $data['lab_u'];
        $tempstudent->comp_lab_unit = $data['com_lab_u'];
        $tempstudent->academic_unit = $data['acad_u'];
        $tempstudent->nstp_unit = $data['nstp_u'];
        $tempstudent->tuition_fee = 0;
        $tempstudent->entrance_fee = 0;
        $tempstudent->admission_fee = 0;
        $tempstudent->athletic_fee = 0;
        $tempstudent->computer_fee = 0;
        $tempstudent->cultural_fee = 0;
        $tempstudent->development_fee = 0;
        $tempstudent->guidance_fee = 0;
        $tempstudent->handbook_fee = 0;
        $tempstudent->laboratory_fee = 0;
        $tempstudent->library_fee = 0;
        $tempstudent->medical_dental_fee = 0;
        $tempstudent->registration_fee = 0;
        $tempstudent->school_id_fee = 0;
        $tempstudent->nstp_fee = 0;
        $tempstudent->stud_cor = 0;
        $tempstudent->total_exam_taken = 0;
        $tempstudent->exam_result = 0;
        $tempstudent->remarks = 0;
        $tempstudent->stud_status = 0;
        $tempstudent->uploaded_by = 0;

        //dummy data
        $tempstudent->ac_year = 2022;
        $tempstudent->hei_psg_region = 13;
        $tempstudent->hei_sid = 01040;
        $tempstudent->hei_uii = 01040;
        $tempstudent->hei_name = "";
        $tempstudent->reference_no = "";
        $tempstudent->year_level = 1;
        $tempstudent->semester = 1;
        $tempstudent->tranche = 1;
        $tempstudent->app_id = 'x';

        $tempstudent->save();
    }


    //Billing Checker functions

    //medyo self explanatory naman to. Eto ung mangayayre pag clinick ung billing checker
    public function queueBillingForChecking($reference_no)
    {
        $billing = Billing::where('reference_no', $reference_no);
        $billing->billing_status = 3;
        $billing->save();
    }
    public function checkBilling()
    {
        //look for billings marked for a checker queue
        $billings = Billing::where('billing_status', 2) //2 muna ginamit ko meaning naka queue
            ->get();

        //check each student of each billing
        foreach ($billings as $billing) {
            //get students of each billing transaction
            $students = TemporaryBilling::where('reference_no', $billing['reference_no'])->orderBy('uid')->get();
            //check each student in billing transaction for duplciates in fhe award number
            foreach ($students as $student) {

                //get duplicate fhe numbers
                $duplicatefheno = $this->getDuplicateFHENo($student('fhe_award_no'), $student('reference_no'));
                //if there are any duplicates they are marked in the remarks
                if (count($duplicatefheno) > 1) {
                    $selectedstudent = TemporaryBilling::find($student['uid']);
                    $selectedstudent->remarks = 'Has a duplicate student';
                    $selectedstudent->save();
                }

                //fetch duplicates in the masterlist
                $duplicateinmasterlist = $this->getDuplicatesStudentsInMasterList(
                    array(
                        'fname' => $student['stud_fname'],
                        'lname' => $student['stud_lname'],
                        'birthdate' => $student['stud_birth_date']
                    )
                );
                //if there are duplicates in the masterlist add a remark
                if (count($duplicateinmasterlist) > 0) {
                    $selectedstudent = TemporaryBilling::find($student['uid']);
                    $selectedstudent->remarks = 'Has a duplicate student in the Master List';
                    $selectedstudent->save();
                }
            }
            //when the billing has been checked. Save it with a new status.
            $selectedbilling = Billing::find($billing['uid']);
            $selectedbilling->billing_status = 3; //3 is done queue
            $selectedbilling->save();

            //write a success message in the logs
            Log::info('Billing Transaction with reference number ' . $billing['reference_no'] . ' has been processed');
        }
    }
    private function getDuplicateFHENo($fhe_award_no, $reference_no)
    {
        $duplicates = TemporaryBilling::where('fhe_award_no', $fhe_award_no)
            ->where('reference_no', $reference_no)
            ->get();
        return $duplicates;
    }
    private function getDuplicatesStudentsInMasterList($data = array())
    {
        $duplicates = Student::where('fname', 'like', '%' . $data['fname'] . '%')
            ->where('lname', 'like', '%' . $data['lname'] . '%')
            ->where('birthdate', $data['birthdate'])
            ->get();
        return $duplicates;
    }

    public function getTempStudents(Request $request)
    {
        $tempstudent = new TemporaryBilling;
        return $tempstudent->getTempStudents($request->reference_no);
    }

    public function getTempStudent(Request $request)
    {
        $tempstudent = new TemporaryBilling;
        return $tempstudent->getTempStudent($request->reference_no);
    }


    public function newStudent(Request $request)
    {
        $student = new Student;
        $student->app_id = $request->app_id;
        $student->fhe_award_no = $request->fhe_award_no;
        $student->tes_award_no = $request->tes_award_no;
        $student->slp_award_no = $request->slp_award_no;
        $student->national_id = $request->national_id;
        $student->student_id = $request->student_id;
        $student->fname = $request->fname;
        $student->mname = $request->mname;
        $student->lname = $request->lname;
        $student->ext_name = $request->ext_name;
        $student->m_fname = $request->m_fname;
        $student->m_mname = $request->m_mname;
        $student->m_lname = $request->m_lname;
        $student->f_fname = $request->f_fname;
        $student->f_mname = $request->f_mname;
        $student->f_lname = $request->f_lname;
        $student->sex = $request->sex;
        $student->lrn = $request->lrn;
        $student->birthplace = $request->birthplace;
        $student->birthdate = $request->birthdate;
        $student->permanent_street = $request->permanent_street;
        $student->permanent_barangay = $request->permanent_barangay;
        $student->permanent_city = $request->permanent_city;
        $student->permanent_province = $request->permanent_province;
        $student->permanent_zip = $request->permanent_zip;
        $student->permanent_district = $request->permanent_district;
        $student->permanent_region = $request->permanent_region;
        $student->present_street = $request->present_street;
        $student->present_barangay = $request->present_barangay;
        $student->present_city = $request->present_city;
        $student->present_province = $request->present_province;
        $student->present_zip = $request->present_zip;
        $student->present_district = $request->present_district;
        $student->present_region = $request->present_region;
        $student->pwd_no = $request->pwd_no;
        $student->contact_no = $request->contact_no;
        $student->alt_contact_no = $request->alt_contact_no;
        $student->email = $request->email;
        $student->alt_email = $request->alt_email;
        $student->nationality = $request->nationality;
        $student->ay_graduate = $request->ay_graduate;

        $student->save();
    }
}
