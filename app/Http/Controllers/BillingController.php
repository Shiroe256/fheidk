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
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new student ajax request
    public function newTempStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required', //modal field name => validation
            'first_name' => 'required',
            'sex' => 'required',
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
                'alt_stud_phone_no' => $request->alt_mobile_number,
                //static
                'trasferee' => '',
                'degree_program' => $request->course_enrolled,
                'year_level' => $request->year_level
            ];
            TemporaryBilling::create($students);
            return response()->json([
                'status' => 200,
            ]);
        }
    }

   // handle edit an employee ajax request
	public function edit(Request $request) {
		$id = $request->uid;
		$students = TemporaryBilling::find($id);
        // $students = TemporaryBilling::firstWhere('uid',$id);
		return response()->json($students);
	}

    //batch upload controller
    public function batchTempStudent(Request $request)
    {
        $tempstudents[] =  json_decode($request->getContent());

        // print_r($tempstudents);
        foreach ($tempstudents[0] as $num => $tempstudent) {
            if (!$this->_newTempStudentBatch($tempstudent)) {
                return response('Error',400);
            }
        }
        return response('Success',200);
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
            'stud_birth_date' => 'required|date_format:Y-m-d',
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
            'stud_phone_no' => 'required|regex:/^(9)\d{9}$/',
            'degree_program' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return 0;
        } else {
            $tempstudent->save();
            return 1;
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
