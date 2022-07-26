<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use app\Models\Student;
use App\Models\TemporaryBilling;

class BillingController extends Controller
{

    public function fetchTempStudent(){
        $TempStudents = TemporaryBilling::all();
        return response()->json([
            'tbl_billing_details_temp'=>$TempStudents,
        ]);
    }

    public function batchTempStudent(Request $request)
    {
        if ($request->isMethod('post')) {
            echo "post";
        }
        foreach ($request as $rownumber => $row) {
            // echo $rownumber;
        }
    }

    //new temporary student
    public function newTempStudent(Request $request)
    {
        $tempstudent = new TemporaryBilling;
        $tempstudent->fhe_award_no = $request->fhe_aw_no;
        $tempstudent->stud_id = $request->stud_no;
        $tempstudent->lrn = $request->lrnum;
        $tempstudent->stud_lname = $request->last_name;
        $tempstudent->stud_fname = $request->given_name;
        $tempstudent->stud_mname = $request->mid_name;
        $tempstudent->stud_ext_name = $request->ext_name;
        $tempstudent->stud_sex = $request->sex_at_birth;
        $tempstudent->stud_birth_date = $request->birthdate;
        $tempstudent->stud_birth_place = $request->birthplace;
        $tempstudent->f_lname = $request->fathers_lname;
        $tempstudent->f_fname = $request->fathers_gname;
        $tempstudent->f_mname = $request->fathers_mname;
        $tempstudent->m_lname = $request->mothers_lname;
        $tempstudent->m_fname = $request->mothers_gname;
        $tempstudent->m_mname = $request->mothers_mname;
        $tempstudent->permanent_prov = $request->perm_prov;
        $tempstudent->permanent_city = $request->perm_city;
        $tempstudent->permanent_brgy = $request->perm_brgy;
        $tempstudent->permanent_street = $request->perm_street;
        $tempstudent->permanent_zip = $request->perm_zip;
        $tempstudent->present_prov = $request->pres_prov;
        $tempstudent->present_city = $request->pres_city;
        $tempstudent->present_brgy = $request->pres_brgy;
        $tempstudent->present_street = $request->pres_street;
        $tempstudent->present_zip = $request->pres_zip;
        $tempstudent->stud_email = $request->email;
        $tempstudent->stud_alt_email = $request->a_email;
        $tempstudent->stud_phone_no = $request->contact_number;
        $tempstudent->stud_alt_phone_no = $request->contact_number_2;
        $tempstudent->transferee = $request->is_transferee;
        $tempstudent->degree_program = $request->degree_course_id;
        $tempstudent->year_level = $request->year_level;
        $tempstudent->lab_unit = $request->lab_u;
        $tempstudent->comp_lab_unit = $request->com_lab_u;
        $tempstudent->academic_unit = $request->acad_u;
        $tempstudent->nstp_unit = $request->nstp_u;
        $tempstudent->total_exam_taken = $request->exams;
        $tempstudent->exam_result = $request->exam_result;
        $tempstudent->remarks = $request->remarks;



        $tempstudent->hei_psg_region = $request->hei_psg_region;
        $tempstudent->hei_sid = $request->hei_sid;
        $tempstudent->hei_uii = $request->hei_uii;
        $tempstudent->hei_name = $request->hei_name;
        $tempstudent->reference_no = $request->reference_no;
        $tempstudent->ac_year = $request->ac_year;
        $tempstudent->semester = $request->semester;
        $tempstudent->tranche = $request->tranche;
        $tempstudent->app_id = $request->app_id;

        // $tempstudent->tuition_fee = $request->tuition_fee;
        // $tempstudent->entrance_fee = $request->entrance_fee;
        // $tempstudent->admission_fee = $request->admission_fee;
        // $tempstudent->athletic_fee = $request->athletic_fee;
        // $tempstudent->computer_fee = $request->computer_fee;
        // $tempstudent->cultural_fee = $request->cultural_fee;
        // $tempstudent->development_fee = $request->development_fee;
        // $tempstudent->guidance_fee = $request->guidance_fee;
        // $tempstudent->handbook_fee = $request->handbook_fee;
        // $tempstudent->laboratory_fee = $request->laboratory_fee;
        // $tempstudent->library_fee = $request->library_fee;
        // $tempstudent->medical_dental_fee = $request->medical_dental_fee;
        // $tempstudent->registration_fee = $request->registration_fee;
        // $tempstudent->school_id_fee = $request->school_id_fee;
        // $tempstudent->nstp_fee = $request->nstp_fee;
        // $tempstudent->stud_cor = $request->stud_cor;
        // $tempstudent->remarks = $request->remarks;
        // $tempstudent->stud_status = $request->stud_status;
        // $tempstudent->uploaded_by = $request->uploaded_by;
        
        $tempstudent->save();
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

    public function deleteTempStudent(Request $request)
    {
        $tempstudent = TemporaryBilling::find($request->uid);
        $tempstudent->delete();
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
