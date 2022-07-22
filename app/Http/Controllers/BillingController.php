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

    //new temporary student
    public function newTempStudent(Request $request)
    {
        $tempstudent = new TemporaryBilling;
        $tempstudent->hei_psg_region = $request->hei_psg_region;
        $tempstudent->hei_sid = $request->hei_sid;
        $tempstudent->hei_uii = $request->hei_uii;
        $tempstudent->hei_name = $request->hei_name;
        $tempstudent->reference_no = $request->reference_no;
        $tempstudent->ac_year = $request->ac_year;
        $tempstudent->semester = $request->semester;
        $tempstudent->tranche = $request->tranche;
        $tempstudent->app_id = $request->app_id;
        $tempstudent->fhe_award_no = $request->fhe_award_no;
        $tempstudent->stud_id = $request->stud_id;
        $tempstudent->lrn_no = $request->lrn_no;
        $tempstudent->stud_lname = $request->stud_lname;
        $tempstudent->stud_fname = $request->stud_fname;
        $tempstudent->stud_mname = $request->stud_mname;
        $tempstudent->stud_ext_name = $request->stud_ext_name;
        $tempstudent->stud_sex = $request->stud_sex;
        $tempstudent->stud_birth_date = $request->stud_birth_date;
        $tempstudent->stud_birth_place = $request->stud_birth_place;
        $tempstudent->f_lname = $request->f_lname;
        $tempstudent->f_fname = $request->f_fname;
        $tempstudent->f_mname = $request->f_mname;
        $tempstudent->m_lname = $request->m_lname;
        $tempstudent->m_fname = $request->m_fname;
        $tempstudent->m_mname = $request->m_mname;
        $tempstudent->present_prov = $request->present_prov;
        $tempstudent->present_city = $request->present_city;
        $tempstudent->present_barangay = $request->present_barangay;
        $tempstudent->present_street = $request->present_street;
        $tempstudent->present_zipcode = $request->present_zipcode;
        $tempstudent->permanent_prov = $request->permanent_prov;
        $tempstudent->permanent_city = $request->permanent_city;
        $tempstudent->permanent_barangay = $request->permanent_barangay;
        $tempstudent->permanent_street = $request->permanent_street;
        $tempstudent->permanent_zipcode = $request->permanent_zipcode;
        $tempstudent->stud_email = $request->stud_email;
        $tempstudent->stud_alt_email = $request->stud_alt_email;
        $tempstudent->stud_phone_no = $request->stud_phone_no;
        $tempstudent->stud_alt_phone_no = $request->stud_alt_phone_no;
        $tempstudent->transferee = $request->transferee;
        $tempstudent->degree_program = $request->degree_program;
        $tempstudent->year_level = $request->year_level;
        $tempstudent->lab_unit = $request->lab_unit;
        $tempstudent->comp_lab_unit = $request->comp_lab_unit;
        $tempstudent->academic_unit = $request->academic_unit;
        $tempstudent->nstp_unit = $request->nstp_unit;
        $tempstudent->tuition_fee = $request->tuition_fee;
        $tempstudent->entrance_fee = $request->entrance_fee;
        $tempstudent->admission_fee = $request->admission_fee;
        $tempstudent->atlhletic_fee = $request->atlhletic_fee;
        $tempstudent->computer_fee = $request->computer_fee;
        $tempstudent->cultural_fee = $request->cultural_fee;
        $tempstudent->development_fee = $request->development_fee;
        $tempstudent->guidance_fee = $request->guidance_fee;
        $tempstudent->handbook_fee = $request->handbook_fee;
        $tempstudent->laboratory_fee = $request->laboratory_fee;
        $tempstudent->library_fee = $request->library_fee;
        $tempstudent->medical_dental_fee = $request->medical_dental_fee;
        $tempstudent->registration_fee = $request->registration_fee;
        $tempstudent->school_id_fee = $request->school_id_fee;
        $tempstudent->nstp_fee = $request->nstp_fee;
        $tempstudent->stud_cor = $request->stud_cor;
        $tempstudent->total_exam_taken = $request->total_exam_taken;
        $tempstudent->exam_result = $request->exam_result;
        $tempstudent->remarks = $request->remarks;
        $tempstudent->stud_status = $request->stud_status;
        $tempstudent->uploaded_by = $request->uploaded_by;
        
        $tempstudent->save();
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
