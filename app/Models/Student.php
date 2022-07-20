<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model{
    
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'course',
    ];

    // public function createStudent($data = array())
    // {
    //     $student = DB::table('tbl_master_student')->insertGetId($data);
    //     return $student;
    // }

    // public function updateStudent($data = array())
    // {
    //     $student = DB::table('tbl_master_student')->where('uid', $data['uid'])
    //     ->update($data);
    //     return $student;
    // }

    // public function getStudent($uid)
    // {
    //     $student = DB::table('tbl_master_student')->where('uid',$uid)->first();
    //     return $student;
    // }

    // public function searchStudents($fname = '', $mname = '', $lname = '')
    // {
    //     $students = DB::table('tbl_master_student')->
    //     where('fname','like','%' .  $fname . '%')->
    //     where('mname','like','%' .  $mname . '%')->
    //     where('lname','like','%' .  $lname . '%')->get();

    //     return $students;
    // }

    // [
    //     'app_id' => $data['app_id'],
    //     'fhe_award_no' => $data['fhe_award_no'],
    //     'tes_award_no' => $data['tes_award_no'],
    //     'slp_award_no' => $data['slp_award_no'],
    //     'national_id' => $data['national_id'],
    //     'fname' => $data['fname'],
    //     'mname' => $data['mname'],
    //     'lname' => $data['lname'],
    //     'ext_name' => $data['ext_name'],
    //     'm_fname' => $data['m_fname'],
    //     'm_mname' => $data['m_mname'],
    //     'm_lname' => $data['m_lname'],
    //     'f_fname' => $data['f_fname'],
    //     'f_mname' => $data['f_mname'],
    //     'f_lname' => $data['f_lname'],
    //     'sex' => $data['sex'],
    //     'lrn' => $data['lrn'],
    //     'birthplace' => $data['birthplace'],
    //     'permanent_street' => $data['permanent_street'],
    //     'permanent_barangay' => $data['permanent_barangay'],
    //     'permanent_city' => $data['permanent_city'],
    //     'permanent_province' => $data['permanent_province'],
    //     'permanent_zip' => $data['permanent_zip'],
    //     'permanent_district' => $data['permanent_district'],
    //     'permanent_region' => $data['permanent_region'],
    //     'present_street' => $data['present_street'],
    //     'present_barangay' => $data['present_barangay'],
    //     'present_city' => $data['present_city'],
    //     'present_province' => $data['present_province'],
    //     'present_zip' => $data['present_zip'],
    //     'present_district' => $data['present_district'],
    //     'pwd_no' => $data['pwd_no'],
    //     'contact_no' => $data['contact_no'],
    //     'alt_contact_no' => $data['alt_contact_no'],
    //     'email' => $data['email'],
    //     'alt_email' => $data['alt_email'],
    //     'nationality' => $data['nationality'],
    //     'ay_graduated' => $data['ay_graduated'],
    // ]
}