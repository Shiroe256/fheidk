<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Hei extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'tbl_heis';
    protected $primaryKey = 'uid';
    public $timestamps = false;
}
