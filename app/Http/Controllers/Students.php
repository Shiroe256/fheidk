<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use app\Models\Student;

class Students extends Controller
{
    public function newStudent($student = array())
    {
        $student_model = new Student();
        $student_model->createStudent($student);
    }
}
