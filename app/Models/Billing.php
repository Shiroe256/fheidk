<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Billing extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $table = 'tbl_fhe_billing_records';
    protected $primaryKey = 'uid';
    public $timestamps = true;
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
        'form1_link',
        'form1_status',
        'form1_remarks',
        'created_by'
    ];

    public function hei()
    {
        return $this->belongsTo(Hei::class, 'hei_uii', 'hei_uii');
    }

    public function students()
    {
        return $this->belongsToMany(TemporaryBilling::class, 'reference_no', 'reference_no');
    }

}
