<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{

    protected $table = 'tbl_master_student_blank';
    protected $primarykey = 'uid';
    //fillable columns
    protected $fillable = [
        'app_id',
        'fhe_award_no',
        'tes_award_no',
        'slp_award_no',
        'national_id',
        'student_id',
        'fname',
        'mname',
        'lname',
        'ext_name',
        'm_fname',
        'm_mname',
        'm_lname',
        'f_fname',
        'f_mname',
        'f_lname',
        'sex',
        'lrn',
        'birthplace',
        'birthdate',
        'permanent_street',
        'permanent_barangay',
        'permanent_city',
        'permanent_province',
        'permanent_zip',
        'permanent_district',
        'permanent_region',
        'present_street',
        'present_barangay',
        'present_city',
        'present_province',
        'present_zip',
        'present_district',
        'present_region',
        'pwd_no',
        'contact_no',
        'alt_contact_no',
        'email',
        'alt_email',
        'nationality',
        'ay_graduated'
    ];

    // public function updateStudent($data = array())
    // {
    //     $student = DB::table('tbl_master_student')->where('uid', $data['uid'])
    //         ->update($data);
    //     return $student;
    // }

    public function getStudent($uid)
    {
        $student = DB::table('tbl_master_student')->where('uid', $uid)->first();
        return $student;
    }

    public function searchStudents($fname = '', $mname = '', $lname = '')
    {
        $students = DB::table('tbl_master_student')->where('fname', 'like', '%' .  $fname . '%')->where('mname', 'like', '%' .  $mname . '%')->where('lname', 'like', '%' .  $lname . '%')->get();


        return $students;
    }
}
