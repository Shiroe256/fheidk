<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hei extends Model
{
    protected $table = 'tbl_heis';
    protected $primaryKey = 'uid';
    public $timestamps = false;


}
