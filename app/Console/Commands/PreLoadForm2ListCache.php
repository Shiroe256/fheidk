<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PreloadForm2ListCache extends Command
{
    protected $signature = 'preload:form2listcache';
    protected $description = 'Preload cache for form 2 list';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch all reference numbers
        $referenceNumbers = DB::table('vw_billing_details')
            ->distinct()
            ->pluck('reference_no');

        foreach ($referenceNumbers as $reference_no) {
            $cacheKey = 'form2list_' . $reference_no;

            // Fetch data for each reference number
            $students = DB::table('vw_billing_details')
                ->select(
                    'stud_uid',
                    'reference_no',
                    'fhe_award_no',
                    'stud_id',
                    'stud_lname',
                    'stud_fname',
                    'stud_mname',
                    'stud_ext_name',
                    'stud_sex',
                    'stud_birth_date',
                    'stud_email',
                    'stud_phone_no',
                    'degree_program',
                    'year_level',
                    'lab_unit',
                    'comp_lab_unit',
                    'academic_unit',
                    'nstp_unit',
                    'remarks',
                    'stud_status',
                    DB::raw('SUM(
                        CASE
                            WHEN type_of_fee = "tuition" AND (coverage = "per unit" OR coverage = "per subject")
                                THEN (academic_unit * amount)
                            WHEN type_of_fee = "tuition" AND coverage = "per student"
                                THEN amount
                            WHEN type_of_fee = "computer" AND (coverage = "per unit" OR coverage = "per subject")
                                THEN (comp_lab_unit * amount)
                            WHEN type_of_fee = "computer" AND coverage = "per student"
                                THEN amount
                            WHEN type_of_fee = "laboratory" AND (coverage = "per unit" OR coverage = "per subject")
                                THEN (lab_unit * amount)
                            WHEN type_of_fee = "laboratory" AND coverage = "per student"
                                THEN amount
                            WHEN type_of_fee = "nstp" AND (coverage = "per unit" OR coverage = "per subject")
                                THEN (nstp_unit * amount)
                            WHEN type_of_fee = "nstp" AND coverage = "per student"
                                THEN amount
                            WHEN type_of_fee IN ("entrance", "admission", "athletic", "cultural", "development", "guidance", "handbook", "library", "medical and dental", "registration", "school id")
                                THEN amount
                            ELSE amount
                        END
                    ) AS total_fee')
                )
                ->where('reference_no', $reference_no)
                ->where('form', 2)
                ->where(function ($query) {
                    $query->where('bs_osf_settings', 1)
                        ->orWhere('bs_student_osf_settings', 1);
                })
                ->groupBy('stud_uid')
                ->get();

            // Store the result in the cache
            Cache::put($cacheKey, $students, now()->addMinutes(1));

            $this->info("Data stored in cache for key: $cacheKey");

            Log::info('Data stored in cache for key: ' . $cacheKey);
        }

        $this->info('Form2List cache preloaded successfully for all reference numbers!');

        Log::info('Form2List cache preloaded successfully for all reference numbers!');
    }
}
