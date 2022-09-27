<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Settings extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'tbl_billing_settings';
    protected $primaryKey = 'bs_uid';
    protected $fillable = [
        'bs_uid',
        'bs_status',
        'bs_osf_uid',
        'bs_reference_no'
    ];
}
