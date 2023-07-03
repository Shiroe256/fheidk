<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Billing;
use App\Models\Hei;
use App\Models\OtherSchoolFees;
use App\Models\Settings;
use App\Models\TemporaryBilling;
use App\Models\StudentDetails;
use App\Models\BillingForm2;
use App\Models\BillingForm3;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function admindashboard()
    {
        return view('admin.dashboard');
    }

    public function manageuserslist()
    {
        return view('admin.manage-users-list');
    }

    public function managebillinglist()
    {
        $heis = Hei::where('fhe_benefits', 1)
            ->orderBy('hei_name', 'asc') // Sort by hei_name in ascending order
            ->get();

        $data['heis'] = $heis;
        return view('admin.manage-billing-list', $data);
    }

    public function managebillingpage($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('reference_no', $reference_no)->first();

        $data['billing'] = $billing;
        return view('admin.manage-billing-page', $data);
    }

    public function form1($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('reference_no', $reference_no)->first();

        // Calculate the total amount
        $totalAmount = TemporaryBilling::sum('total_fees');

        $data['billing'] = $billing;
        $data['totalAmount'] = $totalAmount;

        return view('admin.form1', $data);
    }

    public function form2($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('reference_no', $reference_no)->first();

        $data['billing'] = $billing;

        return view('admin.form2', $data);
    }

    public function fetchform2list(Request $request)
    {

        // $students = BillingForm2::where('reference_no', $reference_no)->get();
        // $totalAmount = $students->sum('total_fee');

        $reference_no = $request->reference_no;

        $students = DB::table('vw_billing_details')
        ->select(
        'vw_billing_details.stud_uid',
        'vw_billing_details.reference_no',
        'vw_billing_details.fhe_award_no',
        'vw_billing_details.stud_id',
        'vw_billing_details.stud_lname',
        'vw_billing_details.stud_fname',
        'vw_billing_details.stud_mname',
        'vw_billing_details.stud_ext_name',
        'vw_billing_details.stud_sex',
        'vw_billing_details.stud_birth_date',
        'vw_billing_details.stud_email',
        'vw_billing_details.stud_phone_no',
        'vw_billing_details.degree_program',
        'vw_billing_details.year_level',
        'vw_billing_details.lab_unit',
        'vw_billing_details.comp_lab_unit',
        'vw_billing_details.academic_unit',
        'vw_billing_details.nstp_unit',
        'vw_billing_details.remarks',
        'vw_billing_details.stud_status',
        DB::raw('SUM(
            CASE
                WHEN (vw_billing_details.type_of_fee = "tuition" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                    THEN (vw_billing_details.academic_unit * vw_billing_details.amount)
                WHEN (vw_billing_details.type_of_fee = "tuition" AND vw_billing_details.coverage = "per student")
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "entrance"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "admission"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "athletic"
                    THEN vw_billing_details.amount
                WHEN (vw_billing_details.type_of_fee = "computer" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                    THEN (vw_billing_details.comp_lab_unit * vw_billing_details.amount)
                WHEN (vw_billing_details.type_of_fee = "computer" AND vw_billing_details.coverage = "per student")
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "cultural"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "development"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "guidance"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "handbook"
                    THEN vw_billing_details.amount
                WHEN (vw_billing_details.type_of_fee = "laboratory" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                    THEN (vw_billing_details.lab_unit * vw_billing_details.amount)
                WHEN (vw_billing_details.type_of_fee = "laboratory" AND vw_billing_details.coverage = "per student")
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "library"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "medical and dental"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "registration"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "school id"
                    THEN vw_billing_details.amount
                WHEN (vw_billing_details.type_of_fee = "nstp" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                    THEN (vw_billing_details.nstp_unit * vw_billing_details.amount)
                WHEN (vw_billing_details.type_of_fee = "nstp" AND vw_billing_details.coverage = "per student")
                    THEN vw_billing_details.amount
                ELSE 0
            END
        ) AS total_fee')
    )
    ->where(function ($query) {
        $query->where('vw_billing_details.bs_osf_settings', 1)
            ->orWhere('vw_billing_details.bs_student_osf_settings', 1);
    })
    ->where('vw_billing_details.form', 2)
    ->where('reference_no', $reference_no)
    ->groupBy('vw_billing_details.stud_uid')
    ->get();

    $totalAmount = $students->sum('total_fee');

        $data['students'] = $students;
        $data['totalAmount'] = $totalAmount;
        return view('admin.elements.form2list', $data);
    }

    // handle edit an student ajax request
    public function viewstudentinfo(Request $request)
    {
        $id = $request->id;
        $viewstudentdetails = DB::table('vw_billing_details')
        ->select(
        'vw_billing_details.stud_uid',
        'vw_billing_details.reference_no',
        'vw_billing_details.hei_psg_region',
        'vw_billing_details.hei_sid',
        'vw_billing_details.hei_uii',
        'vw_billing_details.hei_name',
        'vw_billing_details.ac_year',
        'vw_billing_details.semester',
        'vw_billing_details.app_id',
        'vw_billing_details.fhe_award_no',
        'vw_billing_details.stud_id',
        'vw_billing_details.lrn_no',
        'vw_billing_details.stud_lname',
        'vw_billing_details.stud_fname',
        'vw_billing_details.stud_mname',
        'vw_billing_details.stud_ext_name',
        'vw_billing_details.stud_sex',
        'vw_billing_details.stud_birth_date',
        'vw_billing_details.stud_birth_place',
        'vw_billing_details.f_lname',
        'vw_billing_details.f_fname',
        'vw_billing_details.f_mname',
        'vw_billing_details.m_lname',
        'vw_billing_details.m_fname',
        'vw_billing_details.m_mname',
        'vw_billing_details.present_prov',
        'vw_billing_details.present_city',
        'vw_billing_details.present_barangay',
        'vw_billing_details.present_street',
        'vw_billing_details.present_zipcode',
        'vw_billing_details.permanent_prov',
        'vw_billing_details.permanent_city',
        'vw_billing_details.permanent_barangay',
        'vw_billing_details.permanent_street',
        'vw_billing_details.permanent_zipcode',
        'vw_billing_details.stud_email',
        'vw_billing_details.stud_alt_email',
        'vw_billing_details.stud_phone_no',
        'vw_billing_details.stud_alt_phone_no',
        'vw_billing_details.transferee',
        'vw_billing_details.degree_program',
        'vw_billing_details.year_level',
        'vw_billing_details.lab_unit',
        'vw_billing_details.comp_lab_unit',
        'vw_billing_details.academic_unit',
        'vw_billing_details.nstp_unit',
        'vw_billing_details.remarks',
        'vw_billing_details.stud_status',
        DB::raw('SUM(CASE WHEN (vw_billing_details.type_of_fee = "tuition" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject")) THEN (vw_billing_details.academic_unit * vw_billing_details.amount) ELSE 0 END) + SUM(CASE WHEN (vw_billing_details.type_of_fee = "tuition" AND vw_billing_details.coverage = "per student") THEN vw_billing_details.amount ELSE 0 END) AS tuition_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "entrance" THEN vw_billing_details.amount ELSE 0 END) + SUM(CASE WHEN vw_billing_details.type_of_fee = "admission" THEN vw_billing_details.amount ELSE 0 END) AS entrance_and_admission_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "athletic" THEN vw_billing_details.amount ELSE 0 END) AS athletic_fee'),
        DB::raw('SUM(CASE WHEN (vw_billing_details.type_of_fee = "computer" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject")) THEN (vw_billing_details.comp_lab_unit * vw_billing_details.amount) ELSE 0 END) AS computer_per_unit_fee'), 
        DB::raw('SUM(CASE WHEN (vw_billing_details.type_of_fee = "computer" AND vw_billing_details.coverage = "per student") THEN vw_billing_details.amount ELSE 0 END) AS computer_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "cultural" THEN vw_billing_details.amount ELSE 0 END) AS cultural_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "development" THEN vw_billing_details.amount ELSE 0 END) AS development_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "guidance" THEN vw_billing_details.amount ELSE 0 END) AS guidance_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "handbook" THEN vw_billing_details.amount ELSE 0 END) AS handbook_fee'),
        DB::raw('SUM(CASE WHEN (vw_billing_details.type_of_fee = "laboratory" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject")) THEN (vw_billing_details.lab_unit * vw_billing_details.amount) ELSE 0 END) AS laboratory_per_unit_fee'),
        DB::raw('SUM(CASE WHEN (vw_billing_details.type_of_fee = "laboratory" AND vw_billing_details.coverage = "per student") THEN vw_billing_details.amount ELSE 0 END) AS laboratory_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "library" THEN vw_billing_details.amount ELSE 0 END) AS library_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "medical and dental" THEN vw_billing_details.amount ELSE 0 END) AS medical_and_dental_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "registration" THEN vw_billing_details.amount ELSE 0 END) AS registration_fee'),
        DB::raw('SUM(CASE WHEN vw_billing_details.type_of_fee = "school id" THEN vw_billing_details.amount ELSE 0 END) AS school_id_fee'),
        DB::raw('SUM(CASE WHEN (vw_billing_details.type_of_fee = "nstp" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject")) THEN (vw_billing_details.nstp_unit * vw_billing_details.amount) ELSE 0 END)
         + SUM(CASE WHEN (vw_billing_details.type_of_fee = "nstp" AND vw_billing_details.coverage = "per student") THEN vw_billing_details.amount ELSE 0 END) AS nstp_fee'),
        DB::raw('SUM(
            CASE
                WHEN (vw_billing_details.type_of_fee = "tuition" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                    THEN (vw_billing_details.academic_unit * vw_billing_details.amount)
                WHEN (vw_billing_details.type_of_fee = "tuition" AND vw_billing_details.coverage = "per student")
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "entrance"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "admission"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "athletic"
                    THEN vw_billing_details.amount
                WHEN (vw_billing_details.type_of_fee = "computer" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                    THEN (vw_billing_details.comp_lab_unit * vw_billing_details.amount)
                WHEN (vw_billing_details.type_of_fee = "computer" AND vw_billing_details.coverage = "per student")
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "cultural"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "development"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "guidance"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "handbook"
                    THEN vw_billing_details.amount
                WHEN (vw_billing_details.type_of_fee = "laboratory" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                    THEN (vw_billing_details.lab_unit * vw_billing_details.amount)
                WHEN (vw_billing_details.type_of_fee = "laboratory" AND vw_billing_details.coverage = "per student")
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "library"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "medical and dental"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "registration"
                    THEN vw_billing_details.amount
                WHEN vw_billing_details.type_of_fee = "school id"
                    THEN vw_billing_details.amount
                WHEN (vw_billing_details.type_of_fee = "nstp" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                    THEN (vw_billing_details.nstp_unit * vw_billing_details.amount)
                WHEN (vw_billing_details.type_of_fee = "nstp" AND vw_billing_details.coverage = "per student")
                    THEN vw_billing_details.amount
                ELSE 0
            END
        ) AS total_fee')
    )
    ->where(function ($query) {
        $query->where('vw_billing_details.bs_osf_settings', 1)
            ->orWhere('vw_billing_details.bs_student_osf_settings', 1);
    })
    ->where('vw_billing_details.form', 2)
    ->where('stud_uid', $id)
    ->groupBy('vw_billing_details.stud_uid')
    ->first();
        return response()->json($viewstudentdetails);
    }

    public function form3($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('reference_no', $reference_no)->first();

        $data['billing'] = $billing;

        return view('admin.form3', $data);
    }

    public function fetchform3list(Request $request)
    {
        $reference_no = $request->reference_no;

        // $students = BillingForm3::where('reference_no', $reference_no)->get();
        $students = DB::table('vw_billing_details')
        ->select(
        'vw_billing_details.stud_uid',
        'vw_billing_details.reference_no',
        'vw_billing_details.app_id',
        'vw_billing_details.fhe_award_no',
        'vw_billing_details.stud_lname',
        'vw_billing_details.stud_fname',
        'vw_billing_details.stud_mname',
        'vw_billing_details.stud_ext_name',
        'vw_billing_details.stud_sex',
        'vw_billing_details.stud_birth_date',
        'vw_billing_details.stud_email',
        'vw_billing_details.stud_phone_no',
        'vw_billing_details.degree_program',
        'vw_billing_details.year_level',
        'vw_billing_details.total_exam_taken',
        'vw_billing_details.exam_result',
        'vw_billing_details.remarks',
        'vw_billing_details.stud_status',
        DB::raw('IF(`vw_billing_details`.`stud_status` = 0,
            (SUM(CASE WHEN (`vw_billing_details`.`form` = 3) AND (`vw_billing_details`.`category` LIKE "%exam%") THEN (`vw_billing_details`.`total_exam_taken` * `vw_billing_details`.`amount`) ELSE 0 END)
            + SUM(CASE WHEN (`vw_billing_details`.`form` = 3) AND (NOT (`vw_billing_details`.`category` LIKE "%exam%")) THEN `vw_billing_details`.`amount` ELSE 0 END)),
            IF(`vw_billing_details`.`stud_status` = 4,
                SUM(CASE WHEN (`vw_billing_details`.`form` = 3) AND (`vw_billing_details`.`category` LIKE "%exam%") THEN (`vw_billing_details`.`total_exam_taken` * `vw_billing_details`.`amount`) ELSE 0 END),
                0)) AS entrance_and_admission_fee'
    ))
    ->where(function ($query) {
        $query->where('vw_billing_details.bs_osf_settings', 1)
            ->orWhere('vw_billing_details.bs_student_osf_settings', 1);
    })
    ->where('vw_billing_details.form', 3)
    ->where('reference_no', $reference_no)
    ->groupBy('vw_billing_details.stud_uid')
    ->havingNotNull('entrance_and_admission_fee')
    ->get();
    
    $totalAmount = $students->sum('entrance_and_admission_fee');

        $data['totalAmount'] = $totalAmount;
        $data['students'] = $students;
        return view('admin.elements.form3list', $data);
    }

    public function viewapplicantinfo(Request $request)
    {
        $id = $request->id;
        // $viewapplicantdetails = BillingForm3::where('stud_uid', $id)->first();
        $viewapplicantdetails = DB::table('vw_billing_details')
        ->select(
        'vw_billing_details.stud_uid',
        'vw_billing_details.reference_no',
        'vw_billing_details.hei_psg_region',
        'vw_billing_details.hei_sid',
        'vw_billing_details.hei_uii',
        'vw_billing_details.hei_name',
        'vw_billing_details.ac_year',
        'vw_billing_details.semester',
        'vw_billing_details.app_id',
        'vw_billing_details.fhe_award_no',
        'vw_billing_details.stud_id',
        'vw_billing_details.lrn_no',
        'vw_billing_details.stud_lname',
        'vw_billing_details.stud_fname',
        'vw_billing_details.stud_mname',
        'vw_billing_details.stud_ext_name',
        'vw_billing_details.stud_sex',
        'vw_billing_details.stud_birth_date',
        'vw_billing_details.stud_birth_place',
        'vw_billing_details.f_lname',
        'vw_billing_details.f_fname',
        'vw_billing_details.f_mname',
        'vw_billing_details.m_lname',
        'vw_billing_details.m_fname',
        'vw_billing_details.m_mname',
        'vw_billing_details.present_prov',
        'vw_billing_details.present_city',
        'vw_billing_details.present_street',
        'vw_billing_details.present_zipcode',
        'vw_billing_details.permanent_prov',
        'vw_billing_details.permanent_city',
        'vw_billing_details.permanent_street',
        'vw_billing_details.permanent_zipcode',
        'vw_billing_details.stud_email',
        'vw_billing_details.stud_alt_email',
        'vw_billing_details.stud_phone_no',
        'vw_billing_details.stud_alt_phone_no',
        'vw_billing_details.transferee',
        'vw_billing_details.degree_program',
        'vw_billing_details.year_level',
        'vw_billing_details.total_exam_taken',
        'vw_billing_details.exam_result',
        'vw_billing_details.remarks',
        'vw_billing_details.stud_status',
        DB::raw('IF(`vw_billing_details`.`stud_status` = 0,
            (SUM(CASE WHEN (`vw_billing_details`.`form` = 3) AND (`vw_billing_details`.`category` LIKE "%exam%") THEN (`vw_billing_details`.`total_exam_taken` * `vw_billing_details`.`amount`) ELSE 0 END)
            + SUM(CASE WHEN (`vw_billing_details`.`form` = 3) AND (NOT (`vw_billing_details`.`category` LIKE "%exam%")) THEN `vw_billing_details`.`amount` ELSE 0 END)),
            IF(`vw_billing_details`.`stud_status` = 4,
                SUM(CASE WHEN (`vw_billing_details`.`form` = 3) AND (`vw_billing_details`.`category` LIKE "%exam%") THEN (`vw_billing_details`.`total_exam_taken` * `vw_billing_details`.`amount`) ELSE 0 END),
                0)) AS entrance_and_admission_fee'
    ))
    ->where(function ($query) {
        $query->where('vw_billing_details.bs_osf_settings', 1)
            ->orWhere('vw_billing_details.bs_student_osf_settings', 1);
    })
    ->where('vw_billing_details.form', 3)
    ->where('stud_uid', $id)
    ->groupBy('vw_billing_details.stud_uid')
    ->havingNotNull('entrance_and_admission_fee')
    ->first();

        return response()->json($viewapplicantdetails);
    }


    public function manageuserpage($hei_uii)
    {
        // Retrieve the corresponding Hei model from the database
        $heis = Hei::where('hei_uii', $hei_uii)->first();

        // Check if the Hei model exists
        if (!$heis) {
            abort(404);
        }

        // Pass the $heis variable to the view
        return view('admin.manage-users-page', ['heis' => $heis]);
    }

    public function fetchbillinglist()
    {
        $billings =  Billing::join('vw_billing_details', 'tbl_fhe_billing_records.reference_no', '=', 'vw_billing_details.reference_no')
        ->select(
            'tbl_fhe_billing_records.hei_psg_region',
            'tbl_fhe_billing_records.hei_sid',
            'tbl_fhe_billing_records.hei_uii',
            'tbl_fhe_billing_records.reference_no',
            'tbl_fhe_billing_records.ac_year',
            'tbl_fhe_billing_records.semester',
            DB::raw('COUNT(vw_billing_details.stud_uid) AS total_beneficiaries'),
            DB::raw('SUM(
                CASE
                    WHEN (vw_billing_details.type_of_fee = "tuition" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                        THEN (vw_billing_details.academic_unit * vw_billing_details.amount)
                    WHEN (vw_billing_details.type_of_fee = "tuition" AND vw_billing_details.coverage = "per student")
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "entrance"
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "admission"
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "athletic"
                        THEN vw_billing_details.amount
                    WHEN (vw_billing_details.type_of_fee = "computer" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                        THEN (vw_billing_details.comp_lab_unit * vw_billing_details.amount)
                    WHEN (vw_billing_details.type_of_fee = "computer" AND vw_billing_details.coverage = "per student")
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "cultural"
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "development"
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "guidance"
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "handbook"
                        THEN vw_billing_details.amount
                    WHEN (vw_billing_details.type_of_fee = "laboratory" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                        THEN (vw_billing_details.lab_unit * vw_billing_details.amount)
                    WHEN (vw_billing_details.type_of_fee = "laboratory" AND vw_billing_details.coverage = "per student")
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "library"
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "medical and dental"
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "registration"
                        THEN vw_billing_details.amount
                    WHEN vw_billing_details.type_of_fee = "school id"
                        THEN vw_billing_details.amount
                    WHEN (vw_billing_details.type_of_fee = "nstp" AND (vw_billing_details.coverage = "per unit" OR vw_billing_details.coverage = "per subject"))
                        THEN (vw_billing_details.nstp_unit * vw_billing_details.amount)
                    WHEN (vw_billing_details.type_of_fee = "nstp" AND vw_billing_details.coverage = "per student")
                        THEN vw_billing_details.amount
                    ELSE 0
                END
            ) AS total_amount')
        )
        ->where(function ($query) {
            $query->where('vw_billing_details.bs_osf_settings', 1)
                ->orWhere('vw_billing_details.bs_student_osf_settings', 1);
        })
        ->where('vw_billing_details.form', 2)
        ->groupBy(
            'tbl_fhe_billing_records.reference_no'
        )
        ->get();
    

        // $billings = Billing::all();
        
        $data['billings'] = $billings;
        return view('admin.elements.billinglist', $data);
    }


    public function fetchtosflist(Request $request)
    {
        $hei_uii = $request->hei_uii;
        $fees = OtherSchoolFees::where('hei_uii', $hei_uii)
            ->get();
        $data['fees'] = $fees;
        return view('admin.elements.tosflist', $data);
    }

    public function fetchuserlist()
    {
        $heis = Hei::where('hei_it', 'LUC')
            ->where('fhe_benefits', 1)
            ->get();
        $data['heis'] = $heis;
        return view('admin.elements.userlist', $data);
    }

    // handle insert a new fee ajax request
    public function newfee(Request $request)
    {
        $fee = [
            'ac_year' => '2021-2025',
            'hei_psg_region' => $request->add_tosf_hei_psg_region,
            'hei_uii' => $request->add_tosf_hei_uii,
            'hei_name' => $request->add_tosf_hei_name,
            'year_level' => $request->add_tosf_year_level,
            'semester' => $request->add_tosf_semester,
            'course_enrolled' => $request->add_tosf_degree_program,
            'type_of_fee' => $request->add_tosf_type_of_fee,
            'category' => $request->add_tosf_category,
            'coverage' => $request->add_tosf_coverage,
            'amount' => $request->add_tosf_amount
        ];
        OtherSchoolFees::create($fee);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an student ajax request
    public function editfee(Request $request)
    {
        $id = $request->uid;
        $fee = OtherSchoolFees::find($id);
        return response()->json($fee);
    }

    // handle update an student ajax request
    public function updatefee(Request $request)
    {
        //!validation transferred to middleware
        $fee = OtherSchoolFees::find($request->update_tosf_id);
        $feeData = [
            //actual data being collected in the modal
            'year_level' => $request->update_tosf_year_level,
            'semester' => $request->update_tosf_semester,
            'course_enrolled' => $request->update_tosf_program,
            'type_of_fee' => $request->update_tosf_type_of_fee,
            'category' => $request->update_tosf_category,
            'coverage' => $request->update_tosf_coverage,
            'amount' => $request->update_tosf_amount
        ];
        $fee->update($feeData);
        return response()->json([
            'status' => 200,
        ]);
    }

    //handles delete student information
    public function deletefee(Request $request)
    {
        $id = $request->uid;
        // $students = TemporaryBilling::find($id);
        $fees = OtherSchoolFees::whereIn('uid', $id);
        $fees->delete();
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Load the uploaded file using PHPSpreadsheet
        $filePath = $request->file('file')->getRealPath();
        $ac_year = "2021-2026";
        $hei_uii = $request->upload_tosf_hei_uii;
        $hei_psg_region = $request->upload_tosf_hei_psg_region;
        $hei_name = $request->upload_tosf_hei_name;

        $spreadsheet = IOFactory::load($filePath);

        // Get the first worksheet of the uploaded file
        $worksheet = $spreadsheet->getActiveSheet();

        // Initialize a flag to indicate whether the current row is the header row
        $isHeaderRow = true;

        // Set the batch size
        $batchSize = 1000;

        // Get the highest row number in the worksheet
        $highestRow = $worksheet->getHighestRow();

        // Loop through the rows of the worksheet and insert the data into the database in batches
        for ($i = 1; $i <= $highestRow; $i += $batchSize) {
            $batch = [];
            for ($j = $i; $j < $i + $batchSize; $j++) {
                if ($j > $highestRow) {
                    break;
                }
                $row = $worksheet->getRowIterator($j)->current();

                if ($isHeaderRow) {
                    // Skip the header row
                    $isHeaderRow = false;
                    continue;
                }

                $data = [];
                foreach ($row->getCellIterator() as $cell) {
                    $data[] = $cell->getValue();
                }
                // Validate the data before creating the record
                $validator = Validator::make($data, [
                    'year_level' => 'numeric',
                    'semester' => 'numeric',
                    'amount' => 'numeric',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $batch[] = [
                    'ac_year' => $ac_year,
                    'hei_psg_region' => $hei_psg_region,
                    'hei_uii' => $hei_uii,
                    'hei_name' => $hei_name,
                    'year_level' => $data[4],
                    'semester' => $data[5],
                    'course_enrolled' => $data[6],
                    'type_of_fee' => $data[7],
                    'category' => $data[8],
                    'coverage' => $data[9],
                    'amount' => $data[10],
                ];
            }
            OtherSchoolFees::insert($batch);
        }
        return response()->json([
            'status' => 200,
        ]);
        return view('admin.elements.tosflist');
    }

    public function openbilling(Request $request)
    {
        // Query the database to retrieve the data based on the selected values

        // Check if open_billing_hei is not equal to 'All'
        if ($request->open_billing_hei !== 'All') {
            $heis = Hei::where('hei_uii', $request->open_billing_hei)->get();
        } else {
            $heis = Hei::where('fhe_benefits', 1)->get();
        }

        $newBilling = [];
        $existingReferences = [];
        $schoolsWithoutRecords = [];

        foreach ($heis as $data) {

            $reference_no = $data->hei_psg_region . '-' . $data->hei_uii . '-' . $request->open_billing_ac_year . '-' . $request->open_billing_semester;

            // Check if the reference number already exists in the Billing table
            $existingBilling = Billing::where('reference_no', $reference_no)->first();

            if (!$existingBilling) {
                // Check if hei_uii exists in OtherSchoolFees model
                $existingOtherFee = OtherSchoolFees::where('hei_uii', $data->hei_uii)->first();

                if (!$existingOtherFee) {
                    // hei_uii does not exist, add to schoolsWithoutRecords
                    $schoolsWithoutRecords[] = ['hei_name' => $data->hei_name];
                    continue;
                } else {
                    $newBilling[] = [
                        'hei_psg_region' => $data->hei_psg_region,
                        'hei_sid' => $data->hei_sid,
                        'hei_uii' => $data->hei_uii,
                        'reference_no' => $reference_no,
                        'ac_year' => $request->open_billing_ac_year,
                        'semester' => $request->open_billing_semester,
                        'billing_status' => 1,
                    ];
                }
            } else {
                $existingReferences[] = [
                    'reference_no' => $reference_no,
                    'hei_name' => $data->hei_name,
                ];
            }
        }

        if (!empty($newBilling)) {
            Billing::insert($newBilling);

            $otherfees = OtherSchoolFees::selectRaw('uid')->get();
            $uid = [];
            foreach ($otherfees as $row) {
                $uid[] = $row->uid;
            }

            // Upsert the settings using the first reference number from newBilling
            $firstReference = reset($newBilling);
            $this->upsertSettings($firstReference['reference_no'], $uid);
        }

        $response = [
            'status' => 200,
            // 'data' => $newBilling
        ];

        if (!empty($existingReferences)) {
            $message = 'The following reference number(s) already exist:<br>';
            foreach ($existingReferences as $index => $reference) {
                $message .= ($index + 1) . '. ' . $reference['reference_no'] . ' - ' . $reference['hei_name'] . '<br>';
            }
            $response['message'] = $message;
        }

        if (!empty($schoolsWithoutRecords)) {
            $message = 'The following schools do not have records in TOSF and cannot open billing:<br>';
            foreach ($schoolsWithoutRecords as $index => $school) {
                $message .= ($index + 1) . '. ' . $school['hei_name'] . '<br>';
            }
            $response['message'] = $message;
        }

        return response()->json($response);
    }

    public function forwardtoafms(Request $request)
    {
        $reference_no = $request->reference_no;

        $record = Billing::where('reference_no', $reference_no)->first();

        if (!$record) {
            return response()->json(['error' => $request->reference_no . ' Billing record not found'], 404);
        }

        $records = [
            'billing_status' => 7
        ];

        $record->update($records);

        return response()->json(['message' => $request->reference_no . ' Billing record updated successfully'], 200);
    }

    public function forrevision(Request $request)
    {
        $reference_no = $request->reference_no;

        $record = Billing::where('reference_no', $reference_no)->first();

        if (!$record) {
            return response()->json(['error' => $request->reference_no . ' Billing record not found'], 404);
        }

        $records = [
            'billing_status' => 6
        ];

        $record->update($records);

        return response()->json(['message' => $request->reference_no . ' Billing record updated successfully'], 200);
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

    // handle update an product ajax request
    //  public function updateitemorder(Request $request)
    //  {
    //      //!validation transferred to middleware
    //      $products = PurchaseOrderDetails::find($request->update_manage_purchase_order_product_id);
    //      $productsData = [
    //          //actual data being collected in the modal
    //          'quantity' => $request->update_manage_purchase_order_product_quantity,
    //          'total_amount' => $request->update_manage_purchase_order_product_total_amount
    //      ];
    //      $products->update($productsData);
    //      return response()->json([
    //          'status' => 200,
    //      ]);
    //  }


}
