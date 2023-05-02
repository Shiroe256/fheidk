<?php
namespace App\Imports;

use App\Models\OtherSchoolFees;
use Maatwebsite\Excel\Concerns\ToModel;

require_once '../vendor/autoload.php';

class OtherSchoolFeesImport implements ToModel
{
    public function model(array $row)
    {
        return new OtherSchoolFees([
            'ac_year' => $row[1],
            'hei_psg_region' => $row[2],
            'hei_uii' => $row[3],
            'hei_name' => $row[4],
            'year_level' => $row[5],
            'semester' => $row[6],
            'course_enrolled' => $row[7],
            'type_of_fee' => $row[8],
            'category' => $row[9],
            'coverage' => $row[10],
            'is_optional' => $row[11],
            'amount' => $row[12]
        ]);
    }
}