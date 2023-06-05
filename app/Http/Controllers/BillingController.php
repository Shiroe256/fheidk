<?php

namespace App\Http\Controllers;

use App\Jobs\computeStudentFees;
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
use App\Models\SchoolFees;
use App\Models\StudSettings;
// use App\Models\User;
// use Illuminate\Support\Facades\Storage;
// use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;
use \NumberFormatter;
use App\Jobs\computeFees;

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

        // $hei_uii = Auth::user()->hei_uii;
        $reference_no  = $request->reference_no;
        $search = $request->search['value'];
        $total = DB::table('tbl_billing_details_temp')->where('tbl_billing_details_temp.reference_no', '=', $reference_no)->count();

        // $temporary_billing_info = new TemporaryBilling();
        //students sub query. Dito ung pagination
        $students_sub = DB::table('tbl_billing_details_temp')->where('tbl_billing_details_temp.reference_no', '=', $reference_no)->where(function ($query) use ($search) {
            $query->where('stud_fname', 'like', '%' . $search . '%')
                ->orWhere('stud_lname', 'like', '%' . $search . '%');
        })
            ->skip($request->start)->take($request->length);
        //dito jinojoin ung information about the fees and computation
        $students = DB::table(DB::raw("({$students_sub->toSql()}) AS students_sub"))
            ->mergeBindings($students_sub)
            ->select(
                'students_sub.uid',
                'students_sub.app_id',
                'students_sub.hei_name',
                'students_sub.stud_lname',
                'students_sub.stud_fname',
                'students_sub.stud_mname',
                'students_sub.fhe_award_no',
                'students_sub.degree_program',
                'students_sub.semester',
                'students_sub.year_level',
                'students_sub.remarks',
                'students_sub.stud_status',
                'students_sub.total_fees',
                DB::raw('sum(if(tbl_other_school_fees.coverage = "per student", tbl_other_school_fees.amount, 0)) as total_osf'),
                DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "Tuition", tbl_other_school_fees.amount * students_sub.academic_unit, 0)) as total_tuition'),
                DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "NSTP", tbl_other_school_fees.amount * students_sub.nstp_unit, 0)) as total_nstp'),
                DB::raw('sum(if(tbl_other_school_fees.category = "Laboratory", tbl_other_school_fees.amount * students_sub.lab_unit, 0)) as total_lab'),
                DB::raw('sum(if(tbl_other_school_fees.category = "Computer Laboratory", tbl_other_school_fees.amount * students_sub.comp_lab_unit, 0)) as total_comp_lab'),
                DB::raw('sum(if(tbl_other_school_fees.coverage = "per student", tbl_other_school_fees.amount, 0)) +
sum(if(tbl_other_school_fees.type_of_fee = "Tuition", tbl_other_school_fees.amount * students_sub.academic_unit, 0)) +
sum(if(tbl_other_school_fees.type_of_fee = "NSTP", tbl_other_school_fees.amount * students_sub.nstp_unit, 0)) +
sum(if(tbl_other_school_fees.category = "Laboratory", tbl_other_school_fees.amount * students_sub.lab_unit, 0)) +
sum(if(tbl_other_school_fees.category = "Computer Laboratory", tbl_other_school_fees.amount * students_sub.comp_lab_unit, 0)) as total_fees')
            )
            ->leftJoin('tbl_other_school_fees', function ($join) {
                $join->on('tbl_other_school_fees.course_enrolled', '=', 'students_sub.degree_program')
                    ->on('tbl_other_school_fees.semester', '=', 'students_sub.semester')
                    ->on('tbl_other_school_fees.year_level', '=', 'students_sub.year_level');
            })
            // ->join('tbl_billing_settings', 'tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no')
            ->join('tbl_billing_settings', function ($join) {
                $join->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_other_school_fees.uid')
                    ->on('tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no');
            })
            ->leftJoin('tbl_billing_stud_settings', function ($join) {
                $join->on('tbl_billing_stud_settings.bs_reference_no', '=', 'students_sub.reference_no')
                    ->on('tbl_billing_stud_settings.bs_student', '=', 'students_sub.uid')
                    ->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_billing_stud_settings.bs_osf_uid');
            })
            ->where(function ($query) {
                $query->where('tbl_billing_stud_settings.bs_status', '=', 1)
                    ->where('tbl_billing_settings.bs_status', '=', 1)
                    ->orWhere(function ($query) {
                        $query->whereNull('tbl_billing_stud_settings.bs_status')
                            ->where('tbl_billing_settings.bs_status', '=', 1);
                    });
            })
            ->groupBy('students_sub.uid')->get();

        // $forFeeUpdate = [];
        // foreach ($students as $key => $student) {
        //     $forFeeUpdate[] = ['uid' => $student->uid, 'total_fees' => $student->total_fees];
        // }
        // // $temporary_billing_info->upsert($forFeeUpdate, ['uid'], ['total_fees']);

        // if ($total > 0) {
        //     $idColumn = 'uid';

        //     $caseStatements = collect($forFeeUpdate)->map(function ($row) use ($idColumn) {
        //         return "WHEN {$row[$idColumn]} THEN '{$row['total_fees']}'";
        //     })->implode(' ');

        //     $idValues = implode(',', array_column($forFeeUpdate, $idColumn));

        //     $query = "UPDATE tbl_billing_details_temp SET total_fees = (CASE {$idColumn} {$caseStatements} END) WHERE {$idColumn} IN ({$idValues})";

        //     // echo $query;

        //     DB::statement($query);
        // }

        // //     $sql = "SELECT
        // // `tbl_billing_details_temp`.*,
        // // tbl_billing_settings.bs_osf_uid,
        // // tbl_billing_settings.bs_status,
        // // tbl_billing_stud_settings.bs_osf_uid,
        // // tbl_billing_stud_settings.bs_status,
        // // sum(if(tbl_other_school_fees.coverage = 'per student',tbl_other_school_fees.amount,0)) as total_amount,
        // // sum(if(tbl_other_school_fees.coverage = 'per unit',tbl_other_school_fees.amount * tbl_billing_details_temp.lab_unit,0)) as lab_amount
        // // FROM
        // // `tbl_billing_details_temp`
        // // JOIN tbl_billing_settings ON tbl_billing_settings.bs_reference_no = tbl_billing_details_temp.reference_no
        // // JOIN tbl_other_school_fees ON tbl_other_school_fees.uid = tbl_billing_settings.bs_osf_uid AND tbl_other_school_fees.course_enrolled = tbl_billing_details_temp.degree_program AND tbl_other_school_fees.semester = tbl_billing_details_temp.semester and tbl_other_school_fees.year_level = tbl_billing_details_temp.year_level
        // // LEFT JOIN tbl_billing_stud_settings ON tbl_billing_stud_settings.bs_reference_no = tbl_billing_details_temp.reference_no AND tbl_billing_stud_settings.bs_student = tbl_billing_details_temp.uid AND tbl_billing_settings.bs_osf_uid = tbl_billing_stud_settings.bs_osf_uid
        // // WHERE
        // // tbl_billing_stud_settings.bs_status = 1 OR 
        // // (tbl_billing_stud_settings.bs_status is null and tbl_billing_settings.bs_status = 1) AND
        // // tbl_billing_details_temp.hei_uii = '" . $hei_uii . "' and 
        // // tbl_billing_details_temp.reference_no = '" . $reference_no . "'
        // // group by tbl_billing_details_temp.uid";

        echo json_encode([
            "draw" => $request->draw,
            "recordsTotal" => count($students),
            "recordsFiltered" => $total,
            "data" => $students
        ]);
    }

    public function fetchTempApplicants(Request $request)
    {
        $reference_no  = $request->reference_no;
        $data['applicants'] = TemporaryBilling::orderBy('remarks')
            ->where('reference_no', $reference_no)
            ->whereNotNull('total_exam_taken')
            ->get();
        return view('elements.applicanttable', $data);
    }

    public function fetchTempSummary(Request $request)
    {
        $reference_no  = $request->reference_no;
        $billing_record = Billing::where('reference_no', $reference_no)->first();

        $data['hei_summary'][] = ['hei_name' => $billing_record->hei->hei_name, 'total_beneficiaries' => $billing_record->total_beneficiaries, 'total_amount' => $billing_record->total_amount];

        // if ($billing_record->total_amount < 1) {
        $students_sub = DB::table('tbl_billing_details_temp')->where('tbl_billing_details_temp.reference_no', '=', $reference_no);
        //dito jinojoin ung information about the fees and computation
        $students = DB::table(DB::raw("({$students_sub->toSql()}) AS students_sub"))
            ->mergeBindings($students_sub)
            ->select(
                'students_sub.uid',
                'students_sub.hei_name',
                'tbl_billing_stud_settings.bs_osf_uid',
                'tbl_billing_stud_settings.bs_status',
                DB::raw('sum(if(tbl_other_school_fees.coverage = "per student", tbl_other_school_fees.amount, 0)) as total_osf'),
                DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "Tuition", tbl_other_school_fees.amount * students_sub.academic_unit, 0)) as total_tuition'),
                DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "NSTP", tbl_other_school_fees.amount * students_sub.nstp_unit, 0)) as total_nstp'),
                DB::raw('sum(if(tbl_other_school_fees.category = "Laboratory", tbl_other_school_fees.amount * students_sub.lab_unit, 0)) as total_lab'),
                DB::raw('sum(if(tbl_other_school_fees.category = "Computer Laboratory", tbl_other_school_fees.amount * students_sub.comp_lab_unit, 0)) as total_comp_lab')
            )
            ->leftJoin('tbl_other_school_fees', function ($join) {
                $join->on('tbl_other_school_fees.course_enrolled', '=', 'students_sub.degree_program')
                    ->on('tbl_other_school_fees.semester', '=', 'students_sub.semester')
                    ->on('tbl_other_school_fees.year_level', '=', 'students_sub.year_level');
            })
            // ->join('tbl_billing_settings', 'tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no')
            ->join('tbl_billing_settings', function ($join) {
                $join->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_other_school_fees.uid')
                    ->on('tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no');
            })
            ->leftJoin('tbl_billing_stud_settings', function ($join) {
                $join->on('tbl_billing_stud_settings.bs_reference_no', '=', 'students_sub.reference_no')
                    ->on('tbl_billing_stud_settings.bs_student', '=', 'students_sub.uid')
                    ->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_billing_stud_settings.bs_osf_uid');
            })
            ->where(function ($query) {
                $query->where('tbl_billing_stud_settings.bs_status', '=', 1)
                    // ->andWhere('tbl_billing_settings.bs_status', '=', 1)
                    ->where('tbl_billing_settings.bs_status', '=', 1)
                    ->orWhere(function ($query) {
                        $query->whereNull('tbl_billing_stud_settings.bs_status')
                            ->where('tbl_billing_settings.bs_status', '=', 1);
                    });
            })
            ->groupBy('students_sub.uid');

        $data['hei_summary'] = DB::table(DB::raw("({$students->toSql()}) as students"))
            ->mergeBindings($students)
            ->selectRaw('students.hei_name, COUNT(*) AS total_beneficiaries, sum(students.total_osf) + sum(students.total_tuition) + sum(students.total_nstp) + sum(students.total_lab) + sum(students.total_comp_lab) as total_amount')
            ->get();

        // $billing_record->total_beneficiaries = $data['hei_summary'][0]->total_beneficiaries;
        // $billing_record->total_amount = $data['hei_summary'][0]->total_amount;
        // $billing_record->save();
        // }
        // print_r($data['hei_summary']);
        return view('elements.tempsummary', $data);
    }

    public function fetchTempExceptions(Request $request)
    {
        $reference_no  = $request->reference_no;
        $data['exceptions'] = TemporaryBilling::orderBy('remarks')
            ->where('reference_no', $reference_no)
            ->where('remarks', '!=', '')
            // ->orwhere('remarks', 'Check your spreadsheet. There is a duplicate of this student</br>')
            // ->orwhere('remarks', 'Has exceeded the amount of NSTP units.</br>')
            // ->orwhere('remarks', 'Has a duplicate this year and semester already</br>')
            // ->orwhere('remarks', 'Has a duplicate from other school</br>')
            // ->orwhere('remarks', 'like', '%</br>Exceeded Maximum Residency with years</br>%')
            ->get();
        return view('elements.exceptionsummary', $data);
        // if ($exceptions->count() > 0) {
        //     $output .= '<table class="table table-bordered table-hover table-sm dataTable my-0 table-style" id="tbl_exception_report">
        //     <thead>
        //         <tr>
        //             <th class="text-center"><input type="checkbox" name="main_checkbox"></th>
        //             <th class="text-left">HEI CAMPUS</th>
        //             <th class="text-left">APP ID</th>
        //             <th class="text-left">AWARD NUMBER</th>
        //             <th class="text-left">LASTNAME</th>
        //             <th class="text-left">FIRSTNAME</th>
        //             <th class="text-left">MIDDLENAME</th>
        //             <th>COURSE</th>
        //             <th class="text-center">YEAR</th>
        //             <th class="text-left">REMARKS</th>
        //             <th class="text-left">STATUS</th>
        //             <th class="text-left">AMOUNT BILLED</th>
        //             <th class="text-center">ACTION</th>
        //         </tr>
        //     </thead>
        //     <tbody id="tbl_list_of_exceptions">';
        //     foreach ($exceptions as $exception) {
        //         $total_amount = $exception->tuition_fee + $exception->entrance_fee + $exception->admission_fee + $exception->athletic_fee + $exception->computer_fee + $exception->cultural_fee + $exception->development_fee + $exception->guidance_fee + $exception->handbook_fee + $exception->laboratory_fee + $exception->library_fee + $exception->medical_dental_fee +  $exception->registration_fee + $exception->school_id_fee + $exception->nstp_fee;

        //         $student_status = '';
        //         if ($exception->stud_status == 0) {
        //             $student_status = 'Enrolled';
        //         } elseif ($exception->stud_status == 1) {
        //             $student_status = 'On-LOA';
        //         } elseif ($exception->stud_status == 2) {
        //             $student_status = 'Dropped';
        //         } elseif ($exception->stud_status == 3) {
        //             $student_status = 'Graduated';
        //         } else {
        //             $student_status = '';
        //         }
        //         $output .= '<tr>
        //             <td class="text-center"><input type="checkbox" id="' . $exception->uid . '" name="student_checkbox" value="' . $exception->uid . '"></td>
        //             <td class="text-left">' . $exception->hei_name . '</td>
        //             <td class="text-left">' . $exception->app_id . '</td>
        //             <td class="text-left">' . $exception->fhe_award_no . '</td>
        //             <td>' . $exception->stud_lname . '</td>
        //             <td>' . $exception->stud_fname . '</td>
        //             <td>' . $exception->stud_mname . '</td>
        //             <td>' . $exception->degree_program . '</td>
        //             <td class="text-center">' . $exception->year_level . '</td>
        //             <td class="text-left">' . $exception->remarks . '</td>
        //             <td class="text-left">' . $student_status . '</td>
        //             <td class="text-left">' . $format->format($total_amount) . '</td>
        //             <td class="text-center">
        //                 <div class="btn-group btn-group-sm" role="group">
        //                     <button id="' . $exception->uid . '" class="btn btn_update_student btn-outline-primary" data-bs-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-bs-target="#mod_edit_student_info"><i class="far fa-edit"></i>
        //                     </button>
        //                 </div>
        //             </td>
        //         </tr>';
        //     }
        //     $output .= '</tbody>
        //     </table>';
        //     echo $output;
        // } else {
        //     echo '<h1 class="text-center text-secondary my-5">No exception reports, please run the billing checker again.</h1>';
        // }
    }


    // handle insert a new student ajax request
    public function newTempStudent(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'last_name' => 'required', //modal field name => validation
        //     'first_name' => 'required',
        //     'birthplace' => 'required',
        //     'present_province' => 'required',
        //     'present_city' => 'required',
        //     'present_barangay' => 'required',
        //     'present_zipcode' => 'required',
        //     'permanent_province' => 'required',
        //     'permanent_city' => 'required',
        //     'permanent_barangay' => 'required',
        //     'permanent_zipcode' => 'required',
        //     'email_address' => 'required|email',
        //     'mobile_number' => 'required|regex:/^(09)\d{9}$/',
        //     'course_enrolled' => 'required',
        //     'year_level' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => $validator->messages(),
        //     ]);
        // } else {
        $total_computer_fee = $request->computer_fee_per_unit_amount + $request->computer_fee;
        $students = [
            //static sample data
            'hei_psg_region' => $request->add_hei_psg_region,
            'hei_sid' => Auth::user()->hei_sid,
            'hei_uii' => $request->add_hei_uii,
            'hei_name' => $request->add_selected_campus,
            'reference_no' => $request->add_reference_no,
            'ac_year' => $request->add_ac_year,
            'semester' => $request->add_semester,
            'tranche' => $request->add_tranche,
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
            'lab_unit' => $request->laboratory_units,
            'comp_lab_unit' => $request->computer_fee_per_unit,
            'academic_unit' => $request->total_unit,
            'nstp_unit' => $request->nstp_unit,
            'tuition_fee' => $request->total_tuition,
            'entrance_fee' => $request->entrance_fee,
            'admission_fee' => $request->admission_fee,
            'athletic_fee' => $request->athletic_fee,
            'computer_fee' => $total_computer_fee,
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
        // }
    }

    // handle insert a new applicant ajax request
    public function newTempApplicant(Request $request)
    {

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
        $reference_no  = $request->reference_no;
        $course_enrolled = $request->course_enrolled;
        $year_level = $request->year_level;
        $semester = $request->semester;

        if (is_null($course_enrolled) || empty($course_enrolled) || is_null($year_level) || empty($year_level)) {
            return response()->json(0);
        } else {
            $otherSchoolFees['osf'] = SchoolFees::select(DB::raw('*'))
                ->where('reference_no', $reference_no)
                ->where('course_enrolled', $course_enrolled)
                ->where('year_level', $year_level)
                ->where('semester', $semester)
                ->get();
            return response()->json($otherSchoolFees);
        }
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
        //!validation transferred to middleware
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

    public function newBilling(Request $request)
    {
        $hei_uii = Auth::user()->hei_uii;
        $heiinfo = $this->getHeiInformation($hei_uii);
        $hei_sid = $heiinfo['hei_sid']; //bullshit data lang muna
        $hei_psg_region = $heiinfo['hei_psg_region']; //bullshit data lang muna
        $tranche = 1; //bullshit data lang muna
        $total_beneficaries = 0; //bullshit data lang muna
        $total_amount = 0;
        $billing_status = 1;
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
        echo "/billings/" . $reference_no . "/settings";
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
    }
    public function billingList()
    {
        $data['billings'] = Billing::where('hei_uii', Auth::user()->hei_uii)->get();
        // $hei_uii = Auth::user()->hei_uii;
        // // $data['hei_summary'][] = ['hei_name' => $billing_record->hei->hei_name, 'total_beneficiaries' => $billing_record->total_beneficiaries, 'total_amount' => $billing_record->total_amount];

        // // if ($billing_record->total_amount < 1) {
        // $students_sub = DB::table('tbl_billing_details_temp')->where('tbl_billing_details_temp.hei_uii', '=', $hei_uii);
        // //dito jinojoin ung information about the fees and computation
        // $students = DB::table(DB::raw("({$students_sub->toSql()}) AS students_sub"))
        //     ->mergeBindings($students_sub)
        //     ->select(
        //         'students_sub.uid',
        //         'students_sub.hei_name',
        //         'students_sub.reference_no',
        //         'tbl_billing_stud_settings.bs_osf_uid',
        //         'tbl_billing_stud_settings.bs_status',
        //         DB::raw('sum(if(tbl_other_school_fees.coverage = "per student", tbl_other_school_fees.amount, 0)) as total_osf'),
        //         DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "Tuition", tbl_other_school_fees.amount * students_sub.academic_unit, 0)) as total_tuition'),
        //         DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "NSTP", tbl_other_school_fees.amount * students_sub.nstp_unit, 0)) as total_nstp'),
        //         DB::raw('sum(if(tbl_other_school_fees.category = "Laboratory", tbl_other_school_fees.amount * students_sub.lab_unit, 0)) as total_lab'),
        //         DB::raw('sum(if(tbl_other_school_fees.category = "Computer Laboratory", tbl_other_school_fees.amount * students_sub.comp_lab_unit, 0)) as total_comp_lab')
        //     )
        //     ->leftJoin('tbl_other_school_fees', function ($join) {
        //         $join->on('tbl_other_school_fees.course_enrolled', '=', 'students_sub.degree_program')
        //             ->on('tbl_other_school_fees.semester', '=', 'students_sub.semester')
        //             ->on('tbl_other_school_fees.year_level', '=', 'students_sub.year_level');
        //     })
        //     // ->join('tbl_billing_settings', 'tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no')
        //     ->join('tbl_billing_settings', function ($join) {
        //         $join->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_other_school_fees.uid')
        //             ->on('tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no');
        //     })
        //     ->leftJoin('tbl_billing_stud_settings', function ($join) {
        //         $join->on('tbl_billing_stud_settings.bs_reference_no', '=', 'students_sub.reference_no')
        //             ->on('tbl_billing_stud_settings.bs_student', '=', 'students_sub.uid')
        //             ->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_billing_stud_settings.bs_osf_uid');
        //     })
        //     ->where(function ($query) {
        //         $query->where('tbl_billing_stud_settings.bs_status', '=', 1)
        //             ->where('tbl_billing_settings.bs_status', '=', 1)
        //             ->orWhere(function ($query) {
        //                 $query->whereNull('tbl_billing_stud_settings.bs_status')
        //                     ->where('tbl_billing_settings.bs_status', '=', 1);
        //             });
        //     })
        //     ->groupBy('students_sub.uid');

        // $data['billings'] = DB::table(DB::raw("({$students->toSql()}) as students"))
        //     ->mergeBindings($students)
        //     ->selectRaw('tbl_fhe_billing_records.billing_status, tbl_fhe_billing_records.semester,tbl_fhe_billing_records.ac_year, students.reference_no,students.hei_name, COUNT(*) AS total_beneficiaries, sum(students.total_osf) + sum(students.total_tuition) + sum(students.total_nstp) + sum(students.total_lab) + sum(students.total_comp_lab) as total_amount')
        //     ->rightJoin('tbl_fhe_billing_records','students.reference_no','=','tbl_fhe_billing_records.reference_no')
        //     ->groupBy('students.reference_no')
        //     ->get();

        return view('listofbillings', $data);
    }

    public function billingmanagementpage($reference_no)
    {
        $billings = Billing::where('reference_no', $reference_no)->first();
        // $hei_uii = Auth::user()->hei_uii;
        $data['hei_psg_region'] = $billings->hei_psg_region;
        $data['ac_year'] = $billings->ac_year;
        $data['semester'] = $billings->semester;
        $data['tranche'] = $billings->tranche;
        $data['reference_no'] = $billings->reference_no;
        $data['billing_status'] = $billings->billing_status;
        // if ($billings && $billings->hei_uii == $hei_uii) {
        return view('billingmanagement', $data);
        // }
        // abort(401);
    }

    public function getStudentBillingSettings(Request $request)
    {
        $bs_student = $request->bs_student;
        $course_enrolled = $this->getCourseName($bs_student);
        $reference_no = $request->reference_no;
        $hei_uii = Auth::user()->hei_uii;
        //gather all the categories for everybody in the world
        $otherfees = OtherSchoolFees::join('tbl_billing_settings', 'tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
            // ->leftJoin('tbl_billing_stud_settings', 'tbl_other_school_fees.uid', '=', 'tbl_billing_stud_settings.bs_osf_uid')
            ->leftJoin('tbl_billing_stud_settings', function ($join) use ($bs_student) {
                $join->on('tbl_billing_stud_settings.bs_osf_uid', '=', 'tbl_other_school_fees.uid')
                    ->where('tbl_billing_stud_settings.bs_student', '=', $bs_student);
            })
            ->where('tbl_other_school_fees.hei_uii', $hei_uii)
            ->where('tbl_billing_settings.bs_reference_no', $reference_no)
            ->where('tbl_billing_settings.bs_status', 1)
            ->where('tbl_other_school_fees.course_enrolled', $course_enrolled)
            // ->where('tbl_billing_stud_settings.bs_student', $bs_student)
            ->where('tbl_other_school_fees.is_optional', 1)
            ->selectRaw('tbl_other_school_fees.uid,tbl_other_school_fees.amount,tbl_other_school_fees.course_enrolled,tbl_other_school_fees.type_of_fee,tbl_other_school_fees.category,tbl_other_school_fees.year_level,tbl_other_school_fees.semester,if(tbl_billing_stud_settings.bs_status is not null,tbl_billing_stud_settings.bs_status,tbl_billing_settings.bs_status) as bs_status')
            ->get();

        // $studentfees = StudSettings::where('bs_student', $bs_student)->where('bs_reference_no', $reference_no)->get();

        $otherfeesresult = [];
        foreach ($otherfees as $row) {
            $otherfeesresult[$row->course_enrolled][$row->year_level][$row->semester][$row->type_of_fee][] = array('category' => $row->category, 'id' => $row->uid, 'amount' => $row->amount, 'bs_status' => $row->bs_status);
        }

        //package the shit and put it out of a view
        $data['otherfees'] = $otherfeesresult;

        return view('elements.studentsettings', $data);
    }

    public function getBillingSettings($reference_no)
    {
        $billings = Billing::where('reference_no', $reference_no)->first();
        $data['ac_year'] = $billings->ac_year;
        $data['semester'] = $billings->semester;
        $data['tranche'] = $billings->tranche;
        $hei_uii = Auth::user()->hei_uii;

        //gather all the categories for everybody in the world
        $otherfees = OtherSchoolFees::join('tbl_billing_settings', 'tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
            ->where('hei_uii', $hei_uii)
            ->where('bs_reference_no', $reference_no)
            ->selectRaw('uid,amount,course_enrolled,type_of_fee,category,year_level,semester,bs_status,tbl_billing_settings.updated_at,is_optional')
            ->get();
        if (count($otherfees) < 1) {
            $this->newBillingSettings($reference_no, $hei_uii);
            $otherfees = OtherSchoolFees::join('tbl_billing_settings', 'tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
                ->where('hei_uii', $hei_uii)
                ->where('bs_reference_no', $reference_no)
                ->selectRaw('uid,amount,course_enrolled,type_of_fee,category,year_level,semester,bs_status,tbl_billing_settings.updated_at,is_optional')
                ->get();
        }
        $course_lastupdated = [];
        $otherfeesresult = [];
        foreach ($otherfees as $key => $row) {
            if (!array_key_exists($row->course_enrolled, $course_lastupdated)) {
                $course_lastupdated[$row->course_enrolled] = $row->updated_at;
            }
            //store the shit
            $otherfeesresult[$row->course_enrolled][$row->year_level][$row->semester][$row->type_of_fee][] = array('category' => $row->category, 'id' => $row->uid, 'amount' => $row->amount, 'is_optional' => $row->is_optional, 'bs_status' => $row->bs_status);
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

    // private function getHeiUiiOfBilling($reference_no)
    // {
    //     $hei_uii = Billing::where('reference_no', $reference_no)->first()->hei_uii;
    //     return $hei_uii;
    // }

    public function saveSettings(Request $request)
    {
        // $hei_uii = Auth::user()->hei_uii;
        // if ($hei_uii != $this->getHeiUiiOfBilling($request->reference_no)) {
        //     return response('Unauthorized', 401);
        // }
        //^checks if hei_uii is the same before applying changes

        $onsettings = $request->on;
        $offsettings = $request->off;
        $reference_no = $request->reference_no;
        // echo $reference_no
        $this->upsertSettings($reference_no, $onsettings, $offsettings);
        // echo $reference_no;
        // print_r($offsettings);
        // print_r($onsettings);
    }

    public function toggleStudentFee(Request $request)
    {
        $bs_osf_uid = $request->bs_osf_uid;
        $reference_no = $request->reference_no;

        //prepare array
        foreach ($bs_osf_uid as  $osf) {
            foreach ($request->bs_student as $student) {
                $bs_student[] = array(
                    'bs_reference_no' => $reference_no,
                    'bs_student' => $student,
                    'bs_osf_uid' => $osf['osf'],
                    'bs_status' => $osf['status']
                );
            }
        }
        $studSettings = new StudSettings();
        $studSettings->upsert(
            $bs_student,
            [
                'bs_reference_no',
                'bs_student',
                'bs_osf_uid'
            ],
            ['bs_status']
        );

        //*for ano. Yung update ng fees pag may binagong individual settings. DI NA NEED
        // $chunkSize = 50;
        // $chunks = array_chunk($request->bs_student, $chunkSize);

        // foreach ($chunks as $chunk) {
        //     $this->queueComputationOfFeesPerStudent($reference_no, $chunk);
        // }
        echo 1;
    }

    private function upsertSettings($reference_no, $onsettings = array(), $offsettings = array())
    {
        //mass updates of all the settings that were changed
        //on
        $ons = array();
        $bs_status = 1;
        if ($onsettings) {
            foreach ($onsettings as $osf_uid) {
                $ons[] = array('bs_reference_no' => $reference_no, 'bs_osf_uid' => $osf_uid, 'bs_status' => $bs_status);
            }
        }
        Settings::upsert($ons, ['bs_reference_no', 'bs_osf_uid'], ['bs_status']);
        //off
        $offs = array();
        $bs_status = 0;
        if ($offsettings) {
            foreach ($offsettings as $osf_uid) {
                $offs[] = array('bs_reference_no' => $reference_no, 'bs_osf_uid' => $osf_uid, 'bs_status' => $bs_status);
            }
        }
        Settings::upsert($offs, ['bs_reference_no', 'bs_osf_uid'], ['bs_status']);
    }
    //batch upload controller
    public function batchTempStudent(Request $request)
    {
        $hei_uii = Auth::user()->hei_uii;

        $tempstudents =  json_decode($request->payload, true); //json decode into array (the second parameter)
        //!validation is now passed to the middlware

        $billinginfo = array('reference_no' => $request->reference_no, 'ac_year' => $request->ac_year, 'semester' => $request->semester, 'tranche' => $request->tranche);
        $heiinfo = $this->getHeiInformation($hei_uii);

        //pass validation to each item then return an error and cancel the whole uploading if there are errors
        //!validation has now been passed to the middleware
        // $added = 0;
        $result = $this->parseTempStudentBatch($tempstudents, $heiinfo, $billinginfo);
        //!update fees no longer needed KASI ANG BILIS NA OMG
        // $totalItems = TemporaryBilling::where('reference_no', '=', $request->reference_no)->count();
        // $chunkSize = 50;
        // $offset = 0;

        // while ($offset < $totalItems) {
        //     $limit = min($chunkSize, $totalItems - $offset);
        //     $this->queueComputationOfFees($request->reference_no, $offset, $limit);
        //     $offset += $chunkSize;
        // }

        print_r($result);
    }

    private function parseTempStudentBatch($student = array(), $heiinfo, $billinginfo)
    {
        $tempstudent = [];
        foreach ($student as $key => $data) {
            $hei_uii = Auth::user()->hei_uii;

            // $tempstudent = new TemporaryBilling;
            $tempstudent['fhe_award_no'] = array_key_exists('fhe_aw_no', $data) ? $data['fhe_aw_no'] : $this->generateFHEAwardNo($hei_uii, $key + 1);
            $tempstudent['stud_id'] = array_key_exists('stud_no', $data) ? $data['stud_no'] : '';
            $tempstudent['lrn_no'] = array_key_exists('lrnum', $data) ? $data['lrnum'] : '';
            $tempstudent['stud_lname'] = array_key_exists('last_name', $data) ? $data['last_name'] : '';
            $tempstudent['stud_fname'] = array_key_exists('given_name', $data) ? $data['given_name'] : '';
            $tempstudent['stud_mname'] = array_key_exists('mid_name', $data) ? $data['mid_name'] : '';
            $tempstudent['stud_ext_name'] = array_key_exists('ext_name', $data) ? $data['ext_name'] : '';
            $tempstudent['stud_sex'] = array_key_exists('sex_at_birth', $data) ? $data['sex_at_birth'] : '';
            $d = date_parse_from_format('m/d/Y', $data['birthdate']);
            $tempstudent['stud_birth_date'] = $d['year'] . '-' . $d['month'] . '-' . $d['day'];
            $tempstudent['stud_birth_place'] = array_key_exists('birthplace', $data) ? $data['birthplace'] : '';
            $tempstudent['f_lname'] = array_key_exists('fathers_lname', $data) ? $data['fathers_lname'] : '';
            $tempstudent['f_fname'] = array_key_exists('fathers_gname', $data) ? $data['fathers_gname'] : '';
            $tempstudent['f_mname'] = array_key_exists('fathers_mname', $data) ? $data['fathers_mname'] : '';
            $tempstudent['m_lname'] = array_key_exists('mothers_lname', $data) ? $data['mothers_lname'] : '';
            $tempstudent['m_fname'] = array_key_exists('mothers_gname', $data) ? $data['mothers_gname'] : '';
            $tempstudent['m_mname'] = array_key_exists('mothers_mname', $data) ? $data['mothers_mname'] : '';
            $tempstudent['permanent_prov'] = array_key_exists('perm_prov', $data) ? $data['perm_prov'] : '';
            $tempstudent['permanent_city'] = array_key_exists('perm_city', $data) ? $data['perm_city'] : '';
            $tempstudent['permanent_barangay'] = array_key_exists('perm_brgy', $data) ? $data['perm_brgy'] : '';
            $tempstudent['permanent_street'] = array_key_exists('perm_street', $data) ? $data['perm_street'] : '';
            $tempstudent['permanent_zipcode'] = array_key_exists('perm_zip', $data) ? $data['perm_zip'] : '';
            $tempstudent['present_prov'] = array_key_exists('pres_prov', $data) ? $data['pres_prov'] : '';
            $tempstudent['present_city'] = array_key_exists('pres_city', $data) ? $data['pres_city'] : '';
            $tempstudent['present_barangay'] = array_key_exists('pres_brgy', $data) ? $data['pres_brgy'] : '';
            $tempstudent['present_street'] = array_key_exists('pres_street', $data) ? $data['pres_street'] : '';
            $tempstudent['present_zipcode'] = array_key_exists('pres_zip', $data) ? $data['pres_zip'] : '';
            $tempstudent['stud_email'] = array_key_exists('email', $data) ? $data['email'] : '';
            $tempstudent['stud_alt_email'] = array_key_exists('a_email', $data) ? $data['a_email'] : '';
            $tempstudent['stud_phone_no'] = array_key_exists('contact_number', $data) ? $data['contact_number'] : '';
            $tempstudent['stud_alt_phone_no'] = array_key_exists('contact_number_2', $data) ? $data['contact_number_2'] : '';
            $tempstudent['transferee'] = array_key_exists('is_transferee', $data) ? $data['is_transferee'] : '';

            //dummy data
            $course = strtoupper($data['degree_course_id']);
            $year_level = strtoupper($data['year_level']);
            $tempstudent['degree_program'] = $course;
            $lab_unit = (float) $data['lab_u'];
            $tempstudent['lab_unit'] = $lab_unit;
            $comp_lab_unit = (float) $data['com_lab_u'];
            $tempstudent['comp_lab_unit'] = $comp_lab_unit;
            $tempstudent['academic_unit'] = $data['acad_u'];
            $nstp_unit = array_key_exists('nstp_u', $data) ? $data['nstp_u'] : 0;
            $tempstudent['nstp_unit'] = $nstp_unit;

            $tempstudent['stud_cor'] = 0; //dummydata

            $tempstudent['exam_result'] = array_key_exists('exam_result', $data) ? $data['exam_result'] : '';
            $tempstudent['remarks'] = array_key_exists('remarks', $data) ? $data['remarks'] : '';
            $tempstudent['stud_status'] = 0;
            $tempstudent['uploaded_by'] = Auth::user()->email;

            $tempstudent['ac_year'] = $billinginfo['ac_year'];
            $tempstudent['hei_psg_region'] = $heiinfo['hei_psg_region'];
            $tempstudent['hei_sid'] = $heiinfo['hei_sid'];
            $tempstudent['hei_uii'] = $hei_uii;
            $tempstudent['hei_name'] = $heiinfo['hei_shortname'];
            $tempstudent['reference_no'] = $billinginfo['reference_no'];
            $tempstudent['year_level'] = $year_level;
            $tempstudent['semester'] = $billinginfo['semester'];
            $tempstudent['tranche'] = $billinginfo['tranche'];
            $tempstudent['app_id'] = $this->generateAppID($key + 1);

            $tempstudentforinsert[] = $tempstudent;
        }

        $tempstudentmodel = new TemporaryBilling;
        foreach (array_chunk($tempstudentforinsert, 1200) as $key => $t) {
            if (!$tempstudentmodel->insert($t)) {
                return array('batch' => $key, 'inserted' => ($key + 1) * 1200);
            }
        }

        return array('batch' => -1, 'inserted' => ($key + 1) * 1200);
    }

    private function newTempStudentBatch($data = array(), $heiinfo, $billinginfo, $count)
    {
        // $json_fees = json_decode($json_fees, true); //ung true para maging associative array siya
        $hei_uii = Auth::user()->hei_uii;

        $tempstudent = new TemporaryBilling;
        $tempstudent->fhe_award_no = array_key_exists('fhe_aw_no', $data) ? $data['fhe_aw_no'] : $this->generateFHEAwardNo($hei_uii, $count);
        $tempstudent->stud_id = array_key_exists('stud_no', $data) ? $data['stud_no'] : '';
        $tempstudent->lrn_no = array_key_exists('lrnum', $data) ? $data['lrnum'] : '';
        $tempstudent->stud_lname = array_key_exists('last_name', $data) ? $data['last_name'] : '';
        $tempstudent->stud_fname = array_key_exists('given_name', $data) ? $data['given_name'] : '';
        $tempstudent->stud_mname = array_key_exists('mid_name', $data) ? $data['mid_name'] : '';
        $tempstudent->stud_ext_name = array_key_exists('ext_name', $data) ? $data['ext_name'] : '';
        $tempstudent->stud_sex = array_key_exists('sex_at_birth', $data) ? $data['sex_at_birth'] : '';
        // print_r(date_parse_from_format("m/dY", $data['birthdate']))
        // $d = new DateTime(str_replace("/", "-", $data['birthdate']));
        // $tempstudent->stud_birth_date = $d->format("Y-m-d");
        $d = date_parse_from_format('m/d/Y', $data['birthdate']);
        $tempstudent->stud_birth_date = $d['year'] . '-' . $d['month'] . '-' . $d['day'];
        $tempstudent->stud_birth_place = array_key_exists('birthplace', $data) ? $data['birthplace'] : '';
        $tempstudent->f_lname = array_key_exists('fathers_lname', $data) ? $data['fathers_lname'] : '';
        $tempstudent->f_fname = array_key_exists('fathers_gname', $data) ? $data['fathers_gname'] : '';
        $tempstudent->f_mname = array_key_exists('fathers_mname', $data) ? $data['fathers_mname'] : '';
        $tempstudent->m_lname = array_key_exists('mothers_lname', $data) ? $data['mothers_lname'] : '';
        $tempstudent->m_fname = array_key_exists('mothers_gname', $data) ? $data['mothers_gname'] : '';
        $tempstudent->m_mname = array_key_exists('mothers_mname', $data) ? $data['mothers_mname'] : '';
        $tempstudent->permanent_prov = array_key_exists('perm_prov', $data) ? $data['perm_prov'] : '';
        $tempstudent->permanent_city = array_key_exists('perm_city', $data) ? $data['perm_city'] : '';
        $tempstudent->permanent_barangay = array_key_exists('perm_brgy', $data) ? $data['perm_brgy'] : '';
        $tempstudent->permanent_street = array_key_exists('perm_street', $data) ? $data['perm_street'] : '';
        $tempstudent->permanent_zipcode = array_key_exists('perm_zip', $data) ? $data['perm_zip'] : '';
        $tempstudent->present_prov = array_key_exists('pres_prov', $data) ? $data['pres_prov'] : '';
        $tempstudent->present_city = array_key_exists('pres_city', $data) ? $data['pres_city'] : '';
        $tempstudent->present_barangay = array_key_exists('pres_brgy', $data) ? $data['pres_brgy'] : '';
        $tempstudent->present_street = array_key_exists('pres_street', $data) ? $data['pres_street'] : '';
        $tempstudent->present_zipcode = array_key_exists('pres_zip', $data) ? $data['pres_zip'] : '';
        $tempstudent->stud_email = array_key_exists('email', $data) ? $data['email'] : '';
        $tempstudent->stud_alt_email = array_key_exists('a_email', $data) ? $data['a_email'] : '';
        $tempstudent->stud_phone_no = array_key_exists('contact_number', $data) ? $data['contact_number'] : '';
        $tempstudent->stud_alt_phone_no = array_key_exists('contact_number_2', $data) ? $data['contact_number_2'] : '';
        $tempstudent->transferee = array_key_exists('is_transferee', $data) ? $data['is_transferee'] : '';

        //dummy data
        $course = strtoupper($data['degree_course_id']);
        $year_level = strtoupper($data['year_level']);
        $tempstudent->degree_program = $course;
        $lab_unit = (float) $data['lab_u'];
        $tempstudent->lab_unit = $lab_unit;
        $comp_lab_unit = (float) $data['com_lab_u'];
        $tempstudent->comp_lab_unit = $comp_lab_unit;
        $tempstudent->academic_unit = $data['acad_u'];
        $nstp_unit = array_key_exists('nstp_u', $data) ? $data['nstp_u'] : 0;
        $tempstudent->nstp_unit = $nstp_unit;

        $tempstudent->stud_cor = 0; //dummydata

        $tempstudent->exam_result = array_key_exists('exam_result', $data) ? $data['exam_result'] : '';
        $tempstudent->remarks = array_key_exists('remarks', $data) ? $data['remarks'] : '';
        $tempstudent->stud_status = 0;
        $tempstudent->uploaded_by = Auth::user()->email;

        $tempstudent->ac_year = $billinginfo['ac_year'];
        $tempstudent->hei_psg_region = $heiinfo['hei_psg_region'];
        $tempstudent->hei_sid = $heiinfo['hei_sid'];
        $tempstudent->hei_uii = $hei_uii;
        $tempstudent->hei_name = $heiinfo['hei_shortname'];
        $tempstudent->reference_no = $billinginfo['reference_no'];
        $tempstudent->year_level = $year_level;
        $tempstudent->semester = $billinginfo['semester'];
        $tempstudent->tranche = $billinginfo['tranche'];
        $tempstudent->app_id = $this->generateAppID($count);

        return $tempstudent->save();
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
        $this->checkBilling();
        return response('Success', 200);
    }

    private function getCourseUid($hei_uii, $course)
    {
        $courses = Course::where('hei_uii', $hei_uii)->where('degree_program', $course)->first();
        return $courses->uid;
    }
    private function getCourseName($bs_student)
    {
        $courses = TemporaryBilling::where('uid', $bs_student)->first();
        return $courses->degree_program;
    }

    public function getSheetTemplate()
    {
        $hei_uii = Auth::user()->hei_uii;
        $hei_info = Hei::where('hei_uii', $hei_uii)->first();
        $response['hei_uii'] = $hei_uii;
        $response['hei_name'] = $hei_info->hei_name;
        $response['hei_psg_region'] = $hei_info->hei_psg_region;

        $courses = OtherSchoolFees::select('course_enrolled')->where('hei_uii', $hei_uii)->groupBy('hei_uii', 'course_enrolled')->get();
        $response['courses'] = $courses;
        // $response['reference_no'] = request()->segment(count(request()->segments()));

        echo json_encode($response);
    }

    public function checkBilling()
    {
        //look for billings marked for a checker queue
        $billings = Billing::where('billing_status', 2) //2 muna ginamit ko meaning naka queue
            ->get();
        //check each student of each billing
        foreach ($billings as $billing) {
            $reference_no = $billing['reference_no'];
            //when the billing has been checked. Save it with a new status.

            //set billing status but not save it yet. IF there are no errors ayun

            //get students of each billing transaction
            $students = TemporaryBilling::where('reference_no', $reference_no)->get();
            // echo $students;

            //check each student in billing transaction for duplciates in fhe award number
            $billing->billing_status = 3; //3 is done queue
            foreach ($students as $student) {
                // select student for later updates
                // $student = TemporaryBilling::find($student['uid']);
                // get student and enrollment info
                $remarks = '';

                //fetch duplicates in the masterlist
                $duplicateinmasterlist = Student::where('fname', $student->stud_fname)
                    ->where('lname', $student->stud_lname)
                    ->where('birthdate', $student->stud_birth_date)
                    ->first();

                //if there are duplicates in the masterlist add a remark
                if ($duplicateinmasterlist != null) {
                    printf('meron');
                    $fhe_award_no = $duplicateinmasterlist->fhe_award_no;
                    $student->fhe_award_no = $fhe_award_no;
                    $studentinfo = Student::where('fhe_award_no', $fhe_award_no)->first();
                    // $remarks .= 'FHE award no. automatically selected from Master table</br>';

                    if ($studentinfo == null) {
                        continue;
                    }

                    $enrollmentinfo = EnrollmentInfo::where('app_id', $studentinfo->app_id)->orderBy('ac_year')->orderBy('semester')->get();
                    $firstyear = (float) $enrollmentinfo->first()->ac_year;
                    $firstsem = (float) $enrollmentinfo->first()->semester;
                    $loainfo = EnrollmentInfo::where('status', 2)->orderBy('ac_year')->orderBy('semester')->get(); //LOA
                    $nstpunits = $enrollmentinfo->sum('nstp_unit');
                    //if there are any duplicates for this semester
                    if ($studentinfo->count() > 0) {
                        //compute nstp units
                        if ($nstpunits >= 6) {
                            $remarks .= '<span class="badge badge-secondary">NSTP</span>';
                        }

                        foreach ($enrollmentinfo as $key => $enrollmenti) {

                            if ($enrollmenti->ac_year == $billing->ac_year && $enrollmenti->semester == $billing->semester) {
                                $remarks .= '<span class="badge badge-warning">Duplicate</span>';
                                if ($enrollmenti->hei_uii <> $billing->hei_uii) {
                                    $remarks .= '<span class="badge badge-Dark">Duplicate HEI</span>';
                                }
                            }
                        }

                        //maximum residency start
                        //we have yet to get a database of the duration of courses
                        // $normal_length = $this->getCourseLength($this->getCourseUid($billing->hei_uii, $student->degree_program));
                        $normal_length = 4;
                        $firstsem_discrepancy = $firstsem > 1 ? 0.5 : 0;
                        $lastsem_discrepancy = (float) $billing->semester > 1 ? 0 : 0.5;
                        $length = (float) $billing->ac_year - (float) $firstyear; //count the number of years since it is half of the number of semesters
                        $totallength = $length - $loainfo->count() / 2 - $firstsem_discrepancy + $lastsem_discrepancy;
                        if ($totallength > $normal_length) {
                            //added badge
                            // $remarks .= '<span class="badge badge-danger">' . strval($totallength) . '</span>';
                            $remarks .= '<span class="badge badge-warning">Exceeded MRR</span>';
                        }
                        //maximum residency end
                    }
                }

                $duplicates = TemporaryBilling::where('stud_fname', $student->stud_fname)->where('stud_lname', $student->stud_lname)->where('stud_birth_date', $student->stud_birth_date)->count();
                if ($duplicates > 1) {
                    $remarks .= '<span class="badge badge-danger">Duplicate</span>';
                }

                if ($remarks != '') {
                    $billing->billing_status = 4;
                }
                printf('remarks: ' . $remarks);
                $student->remarks = $remarks;
                $student->save();
            }
            echo "billing done";
            $billing->save();

            //write a success message in the logs
            Log::info('Billing Transaction with reference number ' . $billing['reference_no'] . ' has been processed');
        }
        echo "done";
    }

    public function computeStudFees($bs_student, $reference_no, $year_level, $semester, $course, $billing_settings)
    {
        $studentfees = StudSettings::where('bs_student', $bs_student)->where('bs_reference_no', $reference_no)->get();
        $sum = 0;
        foreach ($billing_settings as $billing_setting) {
            $otherfees[strtoupper($billing_setting->course_enrolled)][$billing_setting->year_level][$billing_setting->semester][] = array('category' => $billing_setting->category, 'id' => $billing_setting->uid, 'amount' => $billing_setting->amount, 'bs_status' => $billing_setting->bs_status);
        }
        foreach ($otherfees[$course][$year_level][$semester] as $otherfee) {
            foreach ($studentfees as $studentfee) {
                if ($studentfee->bs_osf_uid == $otherfee['id'])
                    $otherfee['bs_status'] = $studentfee->bs_status;
            }
            if ($otherfee['bs_status'] == 1) {
                $sum += $otherfee['amount'];
            }
        }

        return $sum;
    }
    public function getStudentFees(Request $request)
    {
        $format = new NumberFormatter('en_PH', NumberFormatter::CURRENCY);
        $bs_student = $request->bs_student;
        //gather all the categories for everybody in the world
        $hei_uii = Auth::user()->hei_uii;

        $students = DB::table('tbl_billing_details_temp')
            ->select(
                'tbl_billing_details_temp.*',
                'tbl_billing_settings.bs_osf_uid',
                'tbl_billing_settings.bs_status',
                'tbl_billing_stud_settings.bs_osf_uid',
                'tbl_billing_stud_settings.bs_status',
                DB::raw('sum(if(tbl_other_school_fees.coverage = "per student", tbl_other_school_fees.amount, 0)) as total_osf'),
                DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "Tuition", tbl_other_school_fees.amount * tbl_billing_details_temp.academic_unit, 0)) as total_tuition'),
                DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "NSTP", tbl_other_school_fees.amount * tbl_billing_details_temp.nstp_unit, 0)) as total_nstp'),
                DB::raw('sum(if(tbl_other_school_fees.category = "Laboratory", tbl_other_school_fees.amount * tbl_billing_details_temp.lab_unit, 0)) as total_lab'),
                DB::raw('sum(if(tbl_other_school_fees.category = "Computer Laboratory", tbl_other_school_fees.amount * tbl_billing_details_temp.comp_lab_unit, 0)) as total_comp_lab')
            )
            ->join('tbl_billing_settings', 'tbl_billing_settings.bs_reference_no', '=', 'tbl_billing_details_temp.reference_no')
            ->join('tbl_other_school_fees', function ($join) {
                $join->on('tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
                    ->on('tbl_other_school_fees.course_enrolled', '=', 'tbl_billing_details_temp.degree_program')
                    ->on('tbl_other_school_fees.semester', '=', 'tbl_billing_details_temp.semester')
                    ->on('tbl_other_school_fees.year_level', '=', 'tbl_billing_details_temp.year_level');
            })
            ->leftJoin('tbl_billing_stud_settings', function ($join) {
                $join->on('tbl_billing_stud_settings.bs_reference_no', '=', 'tbl_billing_details_temp.reference_no')
                    ->on('tbl_billing_stud_settings.bs_student', '=', 'tbl_billing_details_temp.uid')
                    ->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_billing_stud_settings.bs_osf_uid');
            })
            ->where(function ($query) {
                $query->where('tbl_billing_stud_settings.bs_status', '=', 1)
                    ->where('tbl_billing_settings.bs_status', '=', 1)
                    ->orWhere(function ($query) {
                        $query->whereNull('tbl_billing_stud_settings.bs_status')
                            ->where('tbl_billing_settings.bs_status', '=', 1);
                    });
            })
            ->where('tbl_billing_details_temp.hei_uii', '=', $hei_uii)
            ->whereIn('tbl_billing_details_temp.uid', $bs_student)
            ->groupBy('tbl_billing_details_temp.uid')
            ->get();

        $data = [];
        foreach ($students as $student) {
            $data[] = array('bs_student' => $student->uid, 'sum' => $format->format($student->total_osf + $student->total_tuition + $student->total_nstp + $student->total_lab + $student->total_comp_lab));
        }
        // $data['bs_student'] = $bs_student;
        // $data['sum'] = $format->format($student->total_osf + $student->total_tuition + $student->total_nstp + $student->total_lab + $student->total_comp_lab);
        echo json_encode($data);
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
            ->first();
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

    private function generateAppID($seq)
    {
        $app_id = date("YmdHis") . sprintf("%05d", substr(microtime(FALSE), 2, 3)) . '-' . sprintf("%05d", $seq);
        return $app_id;
    }
    private function generateFHEAwardNo($hei_uii, $seq)
    {
        $fhe_award_no = 'FHE-' . date('Y') . $hei_uii . sprintf("%05d", substr(microtime(FALSE), 2, 3)) . sprintf('%05d', $seq);
        return $fhe_award_no;
    }

    private function queueComputationOfFees($reference_no, $start, $length)
    {
        computeFees::dispatch($reference_no, $start, $length);
    }
    private function queueComputationOfFeesPerStudent($reference_no, $uids)
    {
        DB::table('tbl_billing_details_temp')->whereIn('uid', $uids)->update(['total_fees' => -1]);
        computeStudentFees::dispatch($reference_no, $uids);
    }
}
