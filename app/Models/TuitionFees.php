<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TuitionFees extends Model implements Auditable 
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'tbl_tuition_fees';
    public $primaryKey = 'uid';
    protected $fillable = [
        'ac_year',
        'hei_psg_region',
        'hei_uii',
        'hei_name',
        'year_level',
        'semester',
        'course_enrolled',
        'tuition_per_unit',
        'nstp_cost_per_unit'
    ];
}
