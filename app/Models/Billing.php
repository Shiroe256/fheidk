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
        'form2_link',
        'form2_status',
        'form2_remarks',
        'form3_link',
        'form3_status',
        'form3_remarks',
        'reg_cert_link',
        'reg_cert_status',
        'reg_cert_remarks',
        'cor_link',
        'cor_status',
        'cor_remarks',
        'afc_link',
        'afc_status',
        'afc_remarks',
        'hei_bank_cert_link',
        'hei_bank_cert_status',
        'hei_bank_cert_remarks',
        'bank_cert_link',
        'bank_cert_status',
        'bank_cert_remarks',
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
