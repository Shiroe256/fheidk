<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingForm2 extends Model
{
    use HasFactory;
    public $table = "tbl_billing_form_2";
    protected $primaryKey = 'stud_uid';
}
