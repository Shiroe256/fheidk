<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OtherSchoolFees extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'tbl_other_school_fees';
    public $primaryKey = 'uid';
    protected $fillable = [
        'ac_year',
        'hei_psg_region',
        'hei_uii',
        'hei_name',
        'year_level',
        'semester',
        'course_enrolled',
        'type_of_fee',
        'category',
        'coverage',
        'is_optional',
        'amount'
    ];
}
