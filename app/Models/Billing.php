<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'tbl_fhe_billing_records';
    protected $primaryKey = 'uid';
    protected $fillable = [
        'hei_psg_region',
        'hei_sid',
        'hei_uii',
        'reference_no',
        'ac_year',
        'semester',
        'tranche',
        'total_beneficiaries',
        'total_amount',
        'billing_status',
        'created_by'
    ];

}
