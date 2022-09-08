<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryBilling extends Model
{
    use HasFactory;
    protected $table = 'tbl_billing_details_temp';
    public $primaryKey = 'uid';
    protected $fillable = [
        'hei_psg_region',
        'hei_sid',
        'hei_uii',
        'hei_name',
        'reference_no',
        'ac_year',
        'semester',
        'tranche',
        'app_id',
        'fhe_award_no',
        'stud_id',
        'lrn_no',
        'stud_lname',
        'stud_fname',
        'stud_mname',
        'stud_ext_name',
        'stud_sex',
        'stud_birth_date',
        'stud_birth_place',
        'f_lname',
        'f_fname',
        'f_mname',
        'm_lname',
        'm_fname',
        'm_mname',
        'present_prov',
        'present_city',
        'present_barangay',
        'present_street',
        'present_zipcode',
        'permanent_prov',
        'permanent_city',
        'permanent_barangay',
        'permanent_street',
        'permanent_zipcode',
        'stud_email',
        'stud_alt_email',
        'stud_phone_no',
        'stud_alt_phone_no',
        'transferee',
        'degree_program',
        'year_level',
        'lab_unit',
        'comp_lab_unit',
        'academic_unit',
        'nstp_unit',
        'tuition_fee',
        'entrance_fee',
        'admission_fee',
        'athletic_fee',
        'computer_fee',
        'cultural_fee',
        'development_fee',
        'guidance_fee',
        'handbook_fee',
        'laboratory_fee',
        'library_fee',
        'medical_dental_fee',
        'registration_fee',
        'school_id_fee',
        'nstp_fee',
        'stud_cor',
        'total_exam_taken',
        'exam_result',
        'remarks',
        'stud_status',
        'uploaded_by'
    ];
    public $timestamps = false;


    public function getTempStudents($reference_no)
    {
        $tempstudents = DB::table($this->table)->where('reference_no',$reference_no)->get();
        return $tempstudents;
    }

    public function getTempStudentInfo($uid)
    {
        $tempstudent = DB::table($this->table)->where('reference_no',$uid)->get();
        return $tempstudent;
    }
}
