<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'tbl_registry';
    protected $primaryKey = 'uid';
    public $timestamps = false;
    // protected $fillable = [
    //     'hei_psg_region',
    //     'hei_sid',
    //     'hei_uii',
    //     'reference_no',
    //     'ac_year',
    //     'semester',
    //     'tranche',
    //     'total_beneficiaries',
    //     'total_amount',
    //     'billing_status',
    //     'created_by'
    // ];

}
