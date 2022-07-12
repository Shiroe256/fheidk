<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hei extends Model{

    public function createStudent($data = array())
    {
        $hei = DB::table('tbl_master_student')->select('hei_region_nir')->
        addSelect('hei_shortname')->
        addSelect('hei_it')->
        addSelect('hei_ct')->
        where('hei_shortname','like','%'.$data.'%')->
        get();

        echo json_encode($hei);
    }

    public function updateStudent($var = null)
    {
        # code...
    }

    public function getStudent($var = null)
    {
        # code...
    }

    public function searchStudents($var = null)
    {
        # code...
    }

}