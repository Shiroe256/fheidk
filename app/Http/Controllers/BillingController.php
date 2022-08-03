<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
// use app\Models\Student;
use App\Models\TemporaryBilling;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
                    <th class="text-center"><input type="checkbox"></th>
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
                    <td class="text-center"><input type="checkbox"></td>
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
                            <button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i>
                            </button>
                        </div>
                    </td>
                </tr>';
            }
            $output .= '</tbody>
            </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    public function newBilling(Request $request)
    {
        $billing = new Billing;
        $billing->hei_psg_region = $request->hei_psg_region;
        $billing->hei_sid = $request->hei_sid;
        $billing->hei_uii = $request->hei_uii;
        $billing->reference_no = $this->generateBillingReferenceNumber($request->$hei_psg_region, $request->$hei_sid, $request->$ac_year, $request->$semester, $request->$tranche);
        $billing->ac_year = $request->ac_year;
        $billing->semester = $request->semester;
        $billing->tranche = $request->tranche;
        $billing->total_beneficiaries = $request->total_beneficiaries;
        $billing->total_amount = $request->total_amount;
        $billing->billing_status = $request->billing_status;
        $billing->created_by = $request->created_by;

        $billing->save();
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
        $tempstudents[] =  json_decode($request->getContent());

        foreach ($tempstudents[0] as $num => $tempstudent) {
            if (!$this->_newTempStudentBatch($tempstudent)) {
                return response()->json([
                    'status' => 500,
                    'message' => 'There is an error. Please contact the administrator',
                ]);
            }
        }
        return response()->json([
            'status' => 200,
            'message' => 'Student Added Successfully',
        ]);
    }

    public function _newTempStudentBatch($data = array())
    {
        
        $tempstudent = new TemporaryBilling;
        $tempstudent->fhe_award_no = $data->fhe_aw_no;
        $tempstudent->stud_id = $data->stud_no;
        $tempstudent->lrn_no = $data->lrnum;
        $tempstudent->stud_lname = $data->last_name;
        $tempstudent->stud_fname = $data->given_name;
        $tempstudent->stud_mname = $data->mid_name;
        $tempstudent->stud_ext_name = $data->ext_name;
        $tempstudent->stud_sex = $data->sex_at_birth;
        $d = new DateTime(str_replace("/", "-", $tempstudent->birthdate));
        $tempstudent->stud_birth_date = $d->format("Y-m-d");
        $tempstudent->stud_birth_place = $data->birthplace;
        $tempstudent->f_lname = $data->fathers_lname;
        $tempstudent->f_fname = $data->fathers_gname;
        $tempstudent->f_mname = $data->fathers_mname;
        $tempstudent->m_lname = $data->mothers_lname;
        $tempstudent->m_fname = $data->mothers_gname;
        $tempstudent->m_mname = $data->mothers_mname;
        $tempstudent->permanent_prov = $data->perm_prov;
        $tempstudent->permanent_city = $data->perm_city;
        $tempstudent->permanent_barangay = $data->perm_brgy;
        $tempstudent->permanent_street = $data->perm_street;
        $tempstudent->permanent_zipcode = $data->perm_zip;
        $tempstudent->present_prov = $data->pres_prov;
        $tempstudent->present_city = $data->pres_city;
        $tempstudent->present_barangay = $data->pres_brgy;
        $tempstudent->present_street = $data->pres_street;
        $tempstudent->present_zipcode = $data->pres_zip;
        $tempstudent->stud_email = $data->email;
        $tempstudent->stud_alt_email = $data->a_email;
        $tempstudent->stud_phone_no = $data->contact_number;
        $tempstudent->stud_alt_phone_no = $data->contact_number_2;
        $tempstudent->transferee = $data->is_transferee;


        //dummy data
        $tempstudent->degree_program = 69;
        $tempstudent->lab_unit = $data->lab_u;
        $tempstudent->comp_lab_unit = $data->com_lab_u;
        $tempstudent->academic_unit = $data->acad_u;
        $tempstudent->nstp_unit = $data->nstp_u;
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

        $validator = Validator::make($tempstudent->toArray(), [
            'stud_lname' => 'required|max:255',
            'stud_fname' => 'required|max:255',
            'stud_sex' => 'required|max:25',
            // 'stud_birth_date' => 'required|dateformat:dd-MM-yyyy',
            'stud_birth_place' => 'required|max:255',
            'present_prov' => 'required|max:255',
            'present_city' => 'required|max:255',
            'present_barangay' => 'required|max:255',
            'present_zipcode' => 'required|max:255',
            'permanent_prov' => 'required|max:255',
            'permanent_city' => 'required|max:255',
            'permanent_barangay' => 'required|max:255',
            'permanent_zipcode' => 'required|max:255',
            'stud_email' => 'required|email|max:255',
            // 'stud_phone_no' => 'required|regex:/^(09)\d{9}$/',
            'degree_program' => 'required|max:255'

        ]);

        if ($validator->fails()) {
            return 0;
        } else {
            $tempstudent->save();
            return 1;
        }
    }

    //new temporary student
    public function newTempStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stud_lname' => 'required|max:255',
            'stud_fname' => 'required|max:255',
            'stud_sex' => 'required|max:25',
            'stud_birth_date' => 'required|dateformat:dd-MM-yyyy',
            'stud_birth_place' => 'required|max:255',
            'present_prov' => 'required|max:255',
            'present_city' => 'required|max:255',
            'present_barangay' => 'required|max:255',
            'present_zipcode' => 'required|max:255',
            'permanent_prov' => 'required|max:255',
            'permanent_city' => 'required|max:255',
            'permanent_barangay' => 'required|max:255',
            'permanent_zipcode' => 'required|max:255',
            'stud_email' => 'required|email|max:255',
            'stud_phone_no' => 'required|regex:/^(09|\+639)\d{9}$/',
            'degree_program' => 'required|max:255'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
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
                'status' => 200,
                'message' => 'Student Added Successfully',
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
