<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentInfo extends Model
{
    protected $table = 'tbl_enrollment_detail';
    protected $primaryKey = 'uid';
    // public $timestamps = false;
    protected $fillable = [
        'enrollment_id',
        'app_id',
        'hei_uii',
        'ac_year',
        'semester',
        'year_level',
        'status',
        'degree_program',
        'student_id_no',
        'created_at',
        'updated_at'
    ];
}
