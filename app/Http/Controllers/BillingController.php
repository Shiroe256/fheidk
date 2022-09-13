<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\EnrollmentInfo;
use App\Models\Hei;
use App\Models\OtherSchoolFees;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\TemporaryBilling;
use App\Models\TuitionFees;
use App\Models\Student;
use App\Models\Course;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    private function generateBillingReferenceNumber($hei_psg_region, $hei_sid, $ac_year, $semester, $tranche)
    {
        $reference_number = $hei_psg_region . "-" . $hei_sid . "-" . $ac_year . "-" . $semester . "-" . $tranche;
        return $reference_number;
    }

    public function fetchTempStudent(Request $request)
    {
        $reference_no  = $request->reference_no;
        $students = TemporaryBilling::orderBy('remarks')
            ->where('reference_no', $reference_no)
            ->get();
        $output = '';
        if ($students->count() > 0) {
            $output .= '<table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_students">
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
            <tbody id="tbl_list_of_students_form_2">';
            foreach ($students as $student) {
                $total_amount = $student->tuition_fee + $student->entrance_fee + $student->admission_fee + $student->athletic_fee + $student->computer_fee + $student->cultural_fee + $student->development_fee + $student->guidance_fee + $student->handbook_fee + $student->laboratory_fee + $student->library_fee + $student->medical_dental_fee +  $student->registration_fee + $student->school_id_fee + $student->nstp_fee;
                $output .= '<tr>
                    <td class="text-center"><input type="checkbox" id="' . $student->uid . '" name="student_checkbox" value="' . $student->uid . '"></td>
                    <td class="text-left">' . $student->hei_name . '</td>
                    <td class="text-left">' . $student->app_id . '</td>
                    <td class="text-left">' . $student->fhe_award_no . '</td>
                    <td>' . $student->stud_lname . '</td>
                    <td>' . $student->stud_fname . '</td>
                    <td>' . $student->stud_mname . '</td>
                    <td>' . $student->degree_program . '</td>
                    <td class="text-center">' . $student->year_level . '</td>
                    <td class="text-left">' . $student->remarks . '</td>
                    <td class="text-left">' . $student->stud_status . '</td>
                    <td class="text-left">' . $total_amount . '</td>
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

    public function fetchTempApplicants(Request $request)
    {
        $reference_no  = $request->reference_no;
        $applicants = TemporaryBilling::orderBy('remarks')
            ->where('reference_no', $reference_no)
            ->whereNotNull('total_exam_taken')
            ->get();
        $output = '';
        if ($applicants->count() > 0) {
            $output .= ' <table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
            id="tbl_applicants">
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
                    <th class="text-left">STATUS</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody id="tbl_list_of_students_form_3">';
            foreach ($applicants as $applicant) {
                $output .= '<tr>
                    <td class="text-center"><input type="checkbox" id="' . $applicant->uid . '" name="applicant_checkbox" value="' . $applicant->uid . '"></td>
                    <td class="text-left">' . $applicant->hei_name . '</td>
                    <td class="text-left">' . $applicant->app_id . '</td>
                    <td>' . $applicant->stud_lname . '</td>
                    <td>' . $applicant->stud_fname . '</td>
                    <td>' . $applicant->stud_mname . '</td>
                    <td>' . $applicant->degree_program . '</td>
                    <td class="text-center">' . $applicant->year_level . '</td>
                    <td class="text-left">' . $applicant->transferee . '</td>
                    <td class="text-center">' . $applicant->total_exam_taken . '</td>
                    <td class="text-left">' . $applicant->exam_result . '<br></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group">
                            <button id="' . $applicant->uid . '" class="btn btn_update_student btn-outline-info" data-bs-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Applicant Information" data-bs-target="#mod_admission_entrance"><i class="far fa-edit"></i>
                            </button>
                        </div>
                    </td>
                </tr>';
            }
            $output .= '</tbody>
            </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No applicant records.</h1>';
        }
    }

    public function fetchTempSummary(Request $request)
    {
        $reference_no  = $request->reference_no;
        $hei_summary = TemporaryBilling::select(DB::raw('hei_name, COUNT(*) AS total_beneficiaries, (SUM(tuition_fee) + SUM(entrance_fee) + SUM(admission_fee) + SUM(athletic_fee) + SUM(computer_fee) + SUM(cultural_fee) + SUM(development_fee) + SUM(guidance_fee) + SUM(handbook_fee) + SUM(laboratory_fee) + SUM(library_fee) + SUM(medical_dental_fee) + SUM(registration_fee) + SUM(school_id_fee) + SUM(nstp_fee))as total_amount'))
            ->where('reference_no', $reference_no)
            ->groupBy('hei_name')
            ->orderBy('total_amount', 'desc')
            ->get();

        $output = '';
        $cnt = 1;
        if ($hei_summary->count() > 0) {
            $output .= '<table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
            id="tbl_summary">
            <thead>
                <tr>
                    <th class="text-center">NO.</th>
                    <th>HEI CAMPUS</th>
                    <th class="text-center">TOTAL BENEFICIARIES<br></th>
                    <th class="text-center">TOTAL AMOUNT<br></th>
                </tr>
            </thead>
            <tbody id="tbl_list_of_students_form_1">';
            foreach ($hei_summary as $summary) {
                $output .= '<tr>
                <td class="text-center">' . $cnt++ . '</td>
                <td>' . $summary->hei_name . '</td>
                <td class="text-center">' . $summary->total_beneficiaries . '</td>
                <td class="text-center">' . $summary->total_amount . '</td>
            </tr>';
            }
            $output .= '</tbody>
            <tfoot>
            <tr>
                <th colspan="2" class="text-center">GRAND TOTAL</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
            </tr>
            </tfoot>
            </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No billing records.</h1>';
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
                'hei_psg_region' => $request->hei_psg_region,
                'hei_sid' => Auth::user()->hei_sid,
                'hei_uii' => $request->hei_uii,
                'hei_name' => $request->selected_campus,
                'reference_no' => $request->reference_no,
                'ac_year' => $request->ac_year,
                'semester' => $request->semester,
                'tranche' => $request->tranche,
                'app_id' => '',
                'fhe_award_no' => '',
                'stud_id' => $request->stud_id,
                'lrn_no' => $request->lrn_no,
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
                'transferee' => $request->checkbox_transferee,
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

    // handle insert a new applicant ajax request
    public function newTempApplicant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required', //modal field name => validation
            'first_name' => 'required',
            'birthplace' => 'required',
            'email_address' => 'required|email',
            'mobile_number' => 'required|regex:/^(09)\d{9}$/',
            'degree_program_applied' => 'required',
            'year_level' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $applicants = [
                //static sample data
                'hei_psg_region' => $request->hei_psg_region,
                'hei_sid' => Auth::user()->hei_sid,
                'hei_uii' => $request->hei_uii,
                'hei_name' => $request->applied_selected_campus,
                'reference_no' => $request->reference_no,
                'ac_year' => $request->ac_year,
                'semester' => $request->semester,
                'tranche' => $request->tranche,
                'app_id' => '',
                'fhe_award_no' => '',
                'stud_id' => $request->stud_id,
                'lrn_no' => $request->lrn_no,
                //actual data being collected in the modal
                'stud_lname' => $request->last_name, //tablename => $request->name of input field
                'stud_fname' => $request->first_name,
                'stud_mname' => $request->middle_name,
                'stud_ext_name' => $request->extension_name,
                'stud_sex' => $request->sex,
                'stud_birth_date' => $request->birthdate,
                'stud_birth_place' => $request->birthplace,
    
                'stud_email' => $request->email_address,
                'stud_alt_email' => $request->alt_email_address,
                'stud_phone_no' => $request->mobile_number,
                'stud_alt_phone_no' => $request->alt_mobile_number,
        
                'transferee' => $request->checkbox_transferee,
                'degree_program' => $request->degree_program_applied,
                'year_level' => $request->year_level,
                'year_level' => $request->year_level,
                'total_exam_taken' => $request->total_exam_taken,
                'admission_fee' => $request->total_amount,
                'exam_result' => $request->exam_result,
                'stud_cor' => 'sample',
            ];
            TemporaryBilling::create($applicants);
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
    public function selectDegreePrograms()
    {
        $selectDegreePrograms = OtherSchoolFees::select('course_enrolled')
            ->where('hei_uii', Auth::user()->hei_uii)
            ->groupby('course_enrolled')
            ->get();
        return response()->json($selectDegreePrograms);
    }

    public function selectCampus()
    {
        $hei_uii = Auth::user()->hei_uii;
        $heiinfo = $this->getHeiInformation($hei_uii);
        $hei_sid = $heiinfo['hei_sid'];
        if (empty($hei_sid)) {
            return response()->json(0);
        } else {
            $hei = Hei::where('hei_sid', $hei_sid)->get();
            return response()->json($hei);
        }
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
                'hei_name' => $request->edit_selected_campus,
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
                'transferee' => $request->edit_checkbox_transferee,
                'degree_program' => $request->edit_degree_program,
                'year_level' => $request->edit_year_level,
                'lab_unit' => '1',
                'comp_lab_unit' => '1',
                'academic_unit' => $request->edit_total_unit,
                'nstp_unit' => $request->edit_nstp_unit,
                'tuition_fee' => $request->edit_total_tuition,
                'entrance_fee' => $request->edit_entrance_fee,
                'admission_fee' => $request->edit_admission_fee,
                'athletic_fee' => $request->edit_athletic_fee,
                'computer_fee' => $request->edit_computer_fee,
                'cultural_fee' => $request->edit_cultural_fee,
                'development_fee' => $request->edit_development_fee,
                'guidance_fee' => $request->edit_guidance_fee,
                'handbook_fee' => $request->edit_handbook_fee,
                'laboratory_fee' => $request->edit_laboratory_fee,
                'library_fee' => $request->edit_library_fee,
                'medical_dental_fee' => $request->edit_medical_dental_fee,
                'registration_fee' => $request->edit_registration_fee,
                'school_id_fee' => $request->edit_school_id_fee,
                'nstp_fee' => $request->edit_total_nstp,
                'stud_cor' => 'naedit',
                'remarks' => $request->edit_remarks
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

    private function getHeiInformation($hei_uii)
    {
        $hei = Hei::where('hei_uii', $hei_uii)->first();
        $heiinfo = array('hei_psg_region' => $hei->hei_psg_region, 'hei_sid' => $hei->hei_sid, 'hei_shortname' => $hei->hei_shortname);
        return $heiinfo;
    }

    // private function getBillingInformation($reference_no)
    // {
    //     $billing = Billing::where('reference_no', $reference_no)->first();
    //     $billinginfo = array('')
    // }

    public function newBilling(Request $request)
    {
        $hei_uii = Auth::user()->hei_uii;
        $heiinfo = $this->getHeiInformation($hei_uii);
        $hei_sid = $heiinfo['hei_sid']; //bullshit data lang muna
        $hei_psg_region = $heiinfo['hei_psg_region']; //bullshit data lang muna
        $tranche = 1; //bullshit data lang muna
        $total_beneficaries = 0; //bullshit data lang muna
        $total_amount = 0;
        $billing_status = 0;
        $created_by = Auth::user()->email;
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
            'reference_no' => $this->generateBillingReferenceNumber($hei_psg_region, $hei_sid, $request->ac_year, $request->semester, $tranche)
        ];
        $reference_no = Billing::create($billing)->reference_no;

        // echo $reference_no;
        $this->newBillingSettings($reference_no, $hei_uii);
    }

    private function newBillingSettings($reference_no, $hei_uii)
    {
        //adds all the necessary rows for the settings of the billing and are all on by default
        $otherfees = OtherSchoolFees::where('hei_uii', $hei_uii)
            ->selectRaw('uid')
            ->get();
        foreach ($otherfees as $row) {
            //store the shit
            $uid[] = $row->uid;
        }
        $this->upsertSettings($reference_no, $uid);

        echo "/billings/" . $reference_no . "/settings";
    }
    public function billingList()
    {
        $data['billings'] = Billing::where('hei_uii', Auth::user()->hei_uii)->get();
        return view('listofbillings', $data);
    }

    public function billingmanagement($reference_no)
    {
        $billings = Billing::where('reference_no', $reference_no)->first();
        $hei_uii = Auth::user()->hei_uii;
        $data['hei_psg_region'] = $billings->hei_psg_region;
        $data['ac_year'] = $billings->ac_year;
        $data['semester'] = $billings->semester;
        $data['tranche'] = $billings->tranche;
        $data['reference_no'] = $billings->reference_no;
        if ($billings && $billings->hei_uii == $hei_uii) {
            return view('billingmanagement', $data);
        }
        abort(401);
    }


    public function getBillingSettings($reference_no)
    {
        $billings = Billing::where('reference_no', $reference_no)->first();
        $data['ac_year'] = $billings->ac_year;
        $data['semester'] = $billings->semester;
        $data['tranche'] = $billings->tranche;
        $hei_uii = Auth::user()->hei_uii;
        if ($hei_uii != $this->getHeiUiiOfBilling($reference_no)) {
            return response('Unauthorized', 401);
        }

        //gather all the categories for everybody in the world
        $otherfees = OtherSchoolFees::join('tbl_billing_settings', 'tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
            ->where('hei_uii', $hei_uii)
            ->where('bs_reference_no', $reference_no)
            ->selectRaw('uid,amount,course_enrolled,type_of_fee,category,year_level,bs_status,updated_at')
            ->get();
        $course_lastupdated = [];
        $otherfeesresult = [];
        foreach ($otherfees as $key => $row) {
            if (!array_key_exists($row->course_enrolled, $course_lastupdated)) {
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
        $data['reference_no'] = $reference_no;
        return view('billingsettings', $data);
    }

    private function getHeiUiiOfBilling($reference_no)
    {
        $hei_uii = Billing::where('reference_no', $reference_no)->first()->hei_uii;
        return $hei_uii;
    }

    public function saveSettings(Request $request)
    {
        $hei_uii = Auth::user()->hei_uii;
        if ($hei_uii != $this->getHeiUiiOfBilling($request->reference_no)) {
            return response('Unauthorized', 401);
        }
        //^checks if hei_uii is the same before applying changes

        $onsettings = $request->on;
        $offsettings = $request->off;
        $bs_reference_no = $request->reference_no;
        $this->upsertSettings($bs_reference_no, $onsettings, $offsettings);
        echo $bs_reference_no;
    }

    private function upsertSettings($bs_reference_no, $onsettings = array(), $offsettings = array())
    {
        //mass updates of all the settings that were changed
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
        $hei_uii = Auth::user()->hei_uii;

        $tempstudents =  json_decode($request->payload, true); //json decode into array (the second parameter)
        $reference_no = $request->reference_no;
        $billinginfo = array('reference_no' => $request->reference_no, 'ac_year' => $request->ac_year, 'semester' => $request->semester, 'tranche' => $request->tranche);
        $heiinfo = $this->getHeiInformation($hei_uii);
        // echo $reference_no;
        // build the array for fees
        $otherfees = OtherSchoolFees::join('tbl_billing_settings', 'tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
            ->where('hei_uii', $hei_uii)
            ->where('bs_reference_no', $reference_no)
            ->where('bs_status', 1)
            ->where('semester', $request->semester)
            ->selectRaw('course_enrolled,type_of_fee,year_level,SUM(amount) as total_amount')
            ->groupBy('course_enrolled', 'type_of_fee', 'year_level')
            ->get();

        $tuitionFees = TuitionFees::where('hei_uii', $hei_uii)->where('semester', 1)->get();

        foreach ($tuitionFees as $tuitionFee) {
            $fees[strtoupper($tuitionFee->course_enrolled)][strtoupper($tuitionFee->year_level)]['TUITION'] =  $tuitionFee->tuition_per_unit;
            $fees[strtoupper($tuitionFee->course_enrolled)][strtoupper($tuitionFee->year_level)]['NSTP'] =  $tuitionFee->nstp_cost_per_unit;
        }
        foreach ($otherfees as $otherfee) {
            $fees[strtoupper($otherfee->course_enrolled)][strtoupper($otherfee->year_level)][strtoupper($otherfee->type_of_fee)] = $otherfee->total_amount;
        }
        $json_fees = json_encode($fees);
        //build array for fees and tosf end

        //pass validation to each item then return an error and cancel the whole uploading if there are errors
        foreach ($tempstudents as $tempstudent) {
            if ($this->validateTempStudentFields($tempstudent) == FALSE) return response('Invalid', 400);
        }
        //upload all rows if there is no problem
        foreach ($tempstudents as $tempstudent) {
            $this->newTempStudentBatch($tempstudent, $json_fees, $heiinfo, $billinginfo);
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

    // public function test()
    // {
    //     //build the array for fees
    //     $otherfees = OtherSchoolFees::join('tbl_billing_settings', 'tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
    //         ->where('hei_uii', "01040")
    //         ->where('bs_reference_no', "1-11040-2020-2021-1-1")
    //         ->where('bs_status', 1)
    //         ->where('semester', 1)
    //         ->selectRaw('course_enrolled,type_of_fee,year_level,SUM(amount) as total_amount')
    //         ->groupBy('course_enrolled', 'type_of_fee', 'year_level')
    //         ->get();

    //     $tuitionFees = TuitionFees::where('hei_uii', "01040")->where('semester', 1)->get();

    //     foreach ($tuitionFees as $tuitionFee) {
    //         $fees[strtoupper($tuitionFee->course_enrolled)][strtoupper($tuitionFee->year_level)]['TUITION'] =  $tuitionFee->tuition_per_unit;
    //         $fees[strtoupper($tuitionFee->course_enrolled)][strtoupper($tuitionFee->year_level)]['NSTP'] =  $tuitionFee->nstp_cost_per_unit;
    //     }
    //     foreach ($otherfees as $otherfee) {
    //         $fees[strtoupper($otherfee->course_enrolled)][strtoupper($otherfee->year_level)][strtoupper($otherfee->type_of_fee)] = $otherfee->total_amount;
    //     }
    //     //build array for tosf end
    //     // print_r($fees['Bachelor of Science in Information and Technology'][1]);
    //     // echo json_encode($fees);
    //     echo json_encode($fees);
    //     //Admission
    //     //Athletic
    //     //Computer
    //     //Cultural
    //     //Development
    //     //Entrance
    //     //Guidance
    //     //Handbook
    //     //Laboratory
    //     //Library
    //     //Medical and Dental
    //     //Registration
    //     //School ID
    // }

    private function newTempStudentBatch($data = array(), $json_fees, $heiinfo, $billinginfo)
    {
        $json_fees = json_decode($json_fees, true); //ung true para maging associative array siya
        $hei_uii = Auth::user()->hei_uii;

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
        $tempstudent->degree_program = $data['degree_course_id'];
        $tempstudent->lab_unit = $data['lab_u'];
        $tempstudent->comp_lab_unit = $data['com_lab_u'];
        $tempstudent->academic_unit = $data['acad_u'];
        $tempstudent->nstp_unit = is_numeric($data['nstp_u']) ? $data['nstp_u'] : 0;


        //finalized fees
        $Entrance = $this->findKey($json_fees,'ENTRANCE') ? $json_fees[$data['degree_course_id']][$data['year_level']]['ENTRANCE'] : 0;
        $Admission = $this->findKey($json_fees,'ADMISSION') ? $json_fees[$data['degree_course_id']][$data['year_level']]['ADMISSION'] : 0;
        $Athletic = $this->findKey($json_fees,'ATHLETIC') ? $json_fees[$data['degree_course_id']][$data['year_level']]['ATHLETIC'] : 0;
        $Computer = $this->findKey($json_fees,'COMPUTER') ? $json_fees[$data['degree_course_id']][$data['year_level']]['COMPUTER'] : 0;
        $Cultural = $this->findKey($json_fees,'CULTURAL') ? $json_fees[$data['degree_course_id']][$data['year_level']]['CULTURAL'] : 0;
        $Development = $this->findKey($json_fees,'DEVELOPMENT') ? $json_fees[$data['degree_course_id']][$data['year_level']]['DEVELOPMENT'] : 0;
        $Guidance = $this->findKey($json_fees,'GUIDANCE') ? $json_fees[$data['degree_course_id']][$data['year_level']]['GUIDANCE'] : 0;
        $Handbook = $this->findKey($json_fees,'HANDBOOK') ? $json_fees[$data['degree_course_id']][$data['year_level']]['HANDBOOK'] : 0;
        $Laboratory = $this->findKey($json_fees,'LABORATORY') ? $json_fees[$data['degree_course_id']][$data['year_level']]['LABORATORY'] : 0;
        $Library = $this->findKey($json_fees,'LIBRARY') ? $json_fees[$data['degree_course_id']][$data['year_level']]['LIBRARY'] : 0;
        $Medical_and_Dental = $this->findKey($json_fees,'MEDICAL AND DENTAL') ? $json_fees[$data['degree_course_id']][$data['year_level']]['MEDICAL AND DENTAL'] : 0;
        $Registration = $this->findKey($json_fees,'REGISTRATION') ? $json_fees[$data['degree_course_id']][$data['year_level']]['REGISTRATION'] : 0;
        $ID = $this->findKey($json_fees,'SCHOOL ID') ? $json_fees[$data['degree_course_id']][$data['year_level']]['SCHOOL ID'] : 0;

        $tempstudent->tuition_fee = (float) $json_fees[$data['degree_course_id']][$data['year_level']]['TUITION'] * (float) $data['acad_u'];
        $tempstudent->entrance_fee = $Entrance;
        $tempstudent->admission_fee = $Admission;
        $tempstudent->athletic_fee = $Athletic;
        $tempstudent->computer_fee = $Computer;
        $tempstudent->cultural_fee = $Cultural;
        $tempstudent->development_fee = $Development;
        $tempstudent->guidance_fee = $Guidance;
        $tempstudent->handbook_fee = $Handbook;
        $tempstudent->laboratory_fee = $Laboratory;
        $tempstudent->library_fee = $Library;
        $tempstudent->medical_dental_fee = $Medical_and_Dental;
        $tempstudent->registration_fee = $Registration;
        $tempstudent->school_id_fee = $ID;
        $tempstudent->nstp_fee = (float) $json_fees[$data['degree_course_id']][$data['year_level']]['NSTP'] * (float) $data['nstp_u'];
        $tempstudent->stud_cor = 0; //dummydata
        $tempstudent->total_exam_taken = $data['exams'];
        $tempstudent->exam_result = $data['exam_result'];
        $tempstudent->remarks = $data['remarks'];
        $tempstudent->stud_status = 0;
        $tempstudent->uploaded_by = Auth::user()->email;

        $tempstudent->ac_year = $billinginfo['ac_year'];
        $tempstudent->hei_psg_region = $heiinfo['hei_psg_region'];
        $tempstudent->hei_sid = $heiinfo['hei_sid'];
        $tempstudent->hei_uii = $hei_uii;
        $tempstudent->hei_name = $heiinfo['hei_shortname'];
        $tempstudent->reference_no = $billinginfo['reference_no'];
        $tempstudent->year_level = $data['year_level'];
        $tempstudent->semester = $billinginfo['semester'];
        $tempstudent->tranche = $billinginfo['tranche'];
        $tempstudent->app_id = '';

        $tempstudent->save();
    }


    private function findKey($array, $keySearch)
    {
        foreach ($array as $key => $item) {
            if ($key == $keySearch) {
                echo 'yes, it exists';
                return true;
            } elseif (is_array($item) && $this->findKey($item, $keySearch)) {
                return true;
            }
        }
        return false;
    }

    //Billing Checker functions

    //medyo self explanatory naman to. Eto ung mangayayre pag clinick ung billing checker
    public function queueBillingForChecking(Request $request)
    {
        $billing = Billing::where('reference_no', $request->reference_no)->first();
        $billing->billing_status = 2;
        $billing->save();
        return response('Success', 200);
    }

    private function getStudentInfo($fhe_award_no)
    {
        $studentinfo = Student::where('fhe_award_no', $fhe_award_no)->first();
        return $studentinfo;
    }

    private function getCourseUid($hei_uii, $course)
    {
        $courses = Course::where('hei_uii', $hei_uii)->where('degree_program', $course)->first();
        return $courses->uid;
    }

    public function getCourseLength($course_uid)
    {
        $course = Course::find($course_uid);
        $length = (int) $course->normal_length + 1;
        return $length;
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
                //select student for later updates
                $selectedstudent = TemporaryBilling::find($student['uid']);
                //get student and enrollment info
                $studentinfo = $this->getStudentInfo($student->fhe_award_no);
                
                // $course = $this->getCourseLength($student->app_id);
                
                
                if ($student->fhe_award_no != '') {
                    //get duplicate fhe numbers within the billing transaction
                    // $duplicatefheno = $this->getDuplicateFHENo($student('fhe_award_no'), $student('reference_no'));
                    // //if there are any duplicates they are marked in the remarks
                    // if ($duplicatefheno > 1) {
                    //     $selectedstudent->remarks .= 'Has a duplicate student in this Billing Submission';
                    // }
                    if ($studentinfo == null) {
                        continue;
                    }
                    $enrollmentinfo = EnrollmentInfo::where('app_id', $studentinfo->app_id)->orderBy('ac_year', 'semester')->get();
                    $loainfo = EnrollmentInfo::where('app_id', $studentinfo->app_id)->where('status', 2)->orderBy('ac_year', 'semester')->get(); //LOA
                    //if there are any duplicates for this semester
                    if ($studentinfo->count() > 0) {
                        foreach ($enrollmentinfo as $key => $enrollmenti) {
                            // if (array_key_first($enrollmentinfo) == $key) {
                            //     $startacyear = $enrollmenti->ac_year;
                            //     $startsem = $enrollmenti->semester;
                            //     //get start
                            // }
                            if ($enrollmenti->ac_year == $billing->ac_year && $enrollmenti->semester == $billing->semester) {
                                $selectedstudent->remarks .= '\nHas a duplicate this year and semester already';
                                if ($enrollmenti->hei_uii <> $billing->hei_uii) {
                                    $selectedstudent->remarks .= '\nHas a duplicate from other school';
                                }
                            }
                        }

                        //maximum residency start
                        $normal_length = $this->getCourseLength($this->getCourseUid($billing->hei_uii, $student->degree_program));
                        $length = $enrollmentinfo->count() / 2; //count the number of years since it is half of the number of semesters
                        $totallength = $length - $loainfo->count() / 2;
                        if ($totallength > $normal_length) {
                            $selectedstudent->remarks .= '\nExceeded Maximum Resicency';
                        }
                        //maximum residency end

                        //check for duplicates in other schools
                        // $enrollmentinfo = EnrollmentInfo::where('app_id', $studentinfo->app_id)->where('')->get();

                    }
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
                    $selectedstudent->remarks .= '\nHas a duplicate student in the Master List';
                }
                $selectedstudent->save();
            }


            //when the billing has been checked. Save it with a new status.
            $selectedbilling = Billing::find($billing['uid']);
            $selectedbilling->billing_status = 3; //3 is done queue
            $selectedbilling->save();

            //write a success message in the logs
            Log::info('Billing Transaction with reference number ' . $billing['reference_no'] . ' has been processed');
        }
        echo "done";
    }
    private function getDuplicateFHENo($fhe_award_no, $reference_no)
    {
        $duplicates = TemporaryBilling::where('fhe_award_no', $fhe_award_no)
            ->where('reference_no', $reference_no)
            ->get()->count();
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
