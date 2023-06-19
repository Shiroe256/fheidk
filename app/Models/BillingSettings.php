<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingSettings extends Model
{
    use HasFactory;
    public $table = "view_billing_records";
    protected $primaryKey = 'reference_no';
}
