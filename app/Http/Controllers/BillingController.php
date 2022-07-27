<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use app\Models\Student;
use App\Models\TemporaryBilling;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    private function generateBillingReferenceNumber($hei_psg_region, $hei_sid, $ac_year, $semester, $tranche)
    {
        $reference_number = $hei_psg_region . "-" . $hei_sid . "-" . $ac_year . "-" . $semester . "-" . $tranche;
        return $reference_number;
    }

    public function newBilling(Request $request)
    {
        $billing = new Billing;
        $billing->hei_psg_region = $request->hei_psg_region;
        $billing->hei_sid = $request->hei_sid;
        $billing->hei_uii = $request->hei_uii;
        $billing->reference_no = $this->generateBillingReferenceNumber($request->$hei_psg_region,$request->$hei_sid,$request->$ac_year,$request->$semester,$request->$tranche);
        $billing->ac_year = $request->ac_year;
        $billing->semester = $request->semester;
        $billing->tranche = $request->tranche;
        $billing->total_beneficiaries = $request->total_beneficiaries;
        $billing->total_amount = $request->total_amount;
        $billing->billing_status = $request->billing_status;
        $billing->created_by = $request->created_by;

        $billing->save();
    }

    public function fetchTempStudent()
    {
        $TempStudents = TemporaryBilling::all();
        return response()->json([
            'tbl_billing_details_temp' => $TempStudents

        ]);
    }

    // public function store(Request $request) {
	// 	$file = $request->file('avatar');
	// 	$fileName = time() . '.' . $file->getClientOriginalExtension();
	// 	$file->storeAs('public/images', $fileName);

	// 	$studentData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'post' => $request->post, 'avatar' => $fileName];
	// 	Student::create($studentData);
	// 	return response()->json([
	// 		'status' => 200,
	// 	]);
	// }

    // public function store(Request $request){

    //     $validator = Validator::make($request->all(),[
    //         'name'=>'required|max:191',
    //         'email'=>'required|email|max:191',
    //         'phone'=>'required|max:191',
    //         'course'=>'required|max:191',
    //     ]);

    //     if($validator->fails()){
    //         return response()->json([
    //             'status'=>400,
    //             'errors'=>$validator->messages(),
    //         ]);
    //     }else{
    //         $student = new Student;
    //         $student->name = $request->input('name');
    //         $student->email = $request->input('email');
    //         $student->phone = $request->input('phone');
    //         $student->course = $request->input('course');
    //         $student->save();
    //         return response()->json([
    //             'status'=>200,
    //             'message'=>'Student Added Successfully',
    //         ]);
    //     }
    // }

    public function batchTempStudent(Request $request)
    {
        $tempstudents[] =  $request->getContent();
        foreach ($tempstudents as $num => $tempstudent) {
            $this->_newTempStudentBatch($tempstudent);
        }
    }

    public function _newTempStudentBatch($data = array())
    {
        $tempstudent = new TemporaryBilling;
        $tempstudent->fhe_award_no = $data->fhe_aw_no;
        $tempstudent->stud_id = $data->stud_no;
        $tempstudent->lrn = $data->lrnum;
        $tempstudent->stud_lname = $data->last_name;
        $tempstudent->stud_fname = $data->given_name;
        $tempstudent->stud_mname = $data->mid_name;
        $tempstudent->stud_ext_name = $data->ext_name;
        $tempstudent->stud_sex = $data->sex_at_birth;
        $tempstudent->stud_birth_date = $data->birthdate;
        $tempstudent->stud_birth_place = $data->birthplace;
        $tempstudent->f_lname = $data->fathers_lname;
        $tempstudent->f_fname = $data->fathers_gname;
        $tempstudent->f_mname = $data->fathers_mname;
        $tempstudent->m_lname = $data->mothers_lname;
        $tempstudent->m_fname = $data->mothers_gname;
        $tempstudent->m_mname = $data->mothers_mname;
        $tempstudent->permanent_prov = $data->perm_prov;
        $tempstudent->permanent_city = $data->perm_city;
        $tempstudent->permanent_brgy = $data->perm_brgy;
        $tempstudent->permanent_street = $data->perm_street;
        $tempstudent->permanent_zip = $data->perm_zip;
        $tempstudent->present_prov = $data->pres_prov;
        $tempstudent->present_city = $data->pres_city;
        $tempstudent->present_brgy = $data->pres_brgy;
        $tempstudent->present_street = $data->pres_street;
        $tempstudent->present_zip = $data->pres_zip;
        $tempstudent->stud_email = $data->email;
        $tempstudent->stud_alt_email = $data->a_email;
        $tempstudent->stud_phone_no = $data->contact_number;
        $tempstudent->stud_alt_phone_no = $data->contact_number_2;
        $tempstudent->transferee = $data->is_transferee;
        $tempstudent->degree_program = $data->degree_course_id;
        $tempstudent->year_level = $data->year_level;
        $tempstudent->lab_unit = $data->lab_u;
        $tempstudent->comp_lab_unit = $data->com_lab_u;
        $tempstudent->academic_unit = $data->acad_u;
        $tempstudent->nstp_unit = $data->nstp_u;
        $tempstudent->total_exam_taken = $data->exams;
        $tempstudent->exam_result = $data->exam_result;
        $tempstudent->remarks = $data->remarks;



        $tempstudent->hei_psg_region = $data->hei_psg_region;
        $tempstudent->hei_sid = $data->hei_sid;
        $tempstudent->hei_uii = $data->hei_uii;
        $tempstudent->hei_name = $data->hei_name;
        $tempstudent->reference_no = $data->reference_no;
        $tempstudent->ac_year = $data->ac_year;
        $tempstudent->semester = $data->semester;
        $tempstudent->tranche = $data->tranche;
        $tempstudent->app_id = $data->app_id;
    }

    //new temporary student
    public function newTempStudent(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'stud_lname'=>'required|max:255',
            'stud_fname'=>'required|max:255',
            'stud_sex'=>'required|max:25',
            'stud_birth_date'=>'required|dateformat:dd-MM-yyyy',
            'stud_birth_place'=>'required|max:255',
            'present_prov'=>'required|max:255',
            'present_city'=>'required|max:255',
            'present_barangay'=>'required|max:255',
            'present_zipcode'=>'required|max:255',
            'permanent_prov'=>'required|max:255',
            'permanent_city'=>'required|max:255',
            'permanent_barangay'=>'required|max:255',
            'permanent_zipcode'=>'required|max:255',
            'stud_email'=>'required|email|max:255',
            'stud_phone_no' => 'required|regex:/^(09|\+639)\d{9}$/',
            'degree_program'=>'required|max:255'

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
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
            $tempstudent->stud_lname = $request->lname;
            $tempstudent->stud_fname = $request->fname;
            $tempstudent->stud_mname = $request->mname;
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
            return response()->json([
                'status'=>200,
                'message'=>'Student Added Successfully',
            ]);
        }
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
