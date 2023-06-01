<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    use HasFactory;
    public $table = "vw_student_billing_details";
    protected $primaryKey = 'reference_no';
}
