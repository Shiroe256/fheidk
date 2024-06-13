<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\TemporaryBilling;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class computeFees implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $reference_no;
    public $start;
    public $length;

    public function __construct($reference_no, $start, $length)
    {
        $this->reference_no = $reference_no;
        $this->start = $start;
        $this->length = $length;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reference_no  = $this->reference_no;
        $start = $this->start;
        $length = $this->length;
        //students sub query. Dito ung pagination
        $students_sub = DB::table('tbl_billing_details_temp')->where('tbl_billing_details_temp.reference_no', '=', $reference_no)->skip($start)->take($length);
        //dito jinojoin ung information about the fees and computation
        $students = DB::table(DB::raw("({$students_sub->toSql()}) AS students_sub"))
            ->mergeBindings($students_sub)
            ->select(
                'students_sub.uid',
                'students_sub.total_fees',
                DB::raw('sum(if(tbl_other_school_fees.coverage = "per student", tbl_other_school_fees.amount, 0)) as total_osf'),
                DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "Tuition", tbl_other_school_fees.amount * students_sub.academic_unit, 0)) as total_tuition'),
                DB::raw('sum(if(tbl_other_school_fees.type_of_fee = "NSTP", tbl_other_school_fees.amount * students_sub.nstp_unit, 0)) as total_nstp'),
                DB::raw('sum(if(tbl_other_school_fees.category = "Laboratory", tbl_other_school_fees.amount * students_sub.lab_unit, 0)) as total_lab'),
                DB::raw('sum(if(tbl_other_school_fees.category = "Computer Laboratory", tbl_other_school_fees.amount * students_sub.comp_lab_unit, 0)) as total_comp_lab'),
                DB::raw('sum(if(tbl_other_school_fees.coverage = "per student", tbl_other_school_fees.amount, 0)) +
sum(if(tbl_other_school_fees.type_of_fee = "Tuition", tbl_other_school_fees.amount * students_sub.academic_unit, 0)) +
sum(if(tbl_other_school_fees.type_of_fee = "NSTP", tbl_other_school_fees.amount * students_sub.nstp_unit, 0)) +
sum(if(tbl_other_school_fees.category = "Laboratory", tbl_other_school_fees.amount * students_sub.lab_unit, 0)) +
sum(if(tbl_other_school_fees.category = "Computer Laboratory", tbl_other_school_fees.amount * students_sub.comp_lab_unit, 0)) as total_fees')
            )
            ->leftJoin('tbl_billing_settings', 'tbl_billing_settings.bs_reference_no', '=', 'students_sub.reference_no')
            ->leftJoin('tbl_other_school_fees', function ($join) {
                $join->on('tbl_other_school_fees.uid', '=', 'tbl_billing_settings.bs_osf_uid')
                    ->on('tbl_other_school_fees.course_enrolled', '=', 'students_sub.degree_program')
                    ->on('tbl_other_school_fees.semester', '=', 'students_sub.semester')
                    ->on('tbl_other_school_fees.year_level', '=', 'students_sub.year_level');
            })
            ->leftJoin('tbl_billing_stud_settings', function ($join) {
                $join->on('tbl_billing_stud_settings.bs_reference_no', '=', 'students_sub.reference_no')
                    ->on('tbl_billing_stud_settings.bs_student', '=', 'students_sub.uid')
                    ->on('tbl_billing_settings.bs_osf_uid', '=', 'tbl_billing_stud_settings.bs_osf_uid');
            })
            ->where(function ($query) {
                $query->where('tbl_billing_stud_settings.bs_status', '=', 1)
                    ->where('tbl_billing_settings.bs_status', '=', 1)
                    ->orWhere(function ($query) {
                        $query->whereNull('tbl_billing_stud_settings.bs_status')
                            ->where('tbl_billing_settings.bs_status', '=', 1);
                    });
            })
            ->groupBy('students_sub.uid')->get();

        $forFeeUpdate = [];
        foreach ($students as $key => $student) {
            $forFeeUpdate[] = ['uid' => $student->uid, 'total_fees' => $student->total_fees];
        }
        // $temporary_billing_info->upsert($forFeeUpdate, ['uid'], ['total_fees']);

        $idColumn = 'uid';

        $caseStatements = collect($forFeeUpdate)->map(function ($row) use ($idColumn) {
            return "WHEN {$row[$idColumn]} THEN '{$row['total_fees']}'";
        })->implode(' ');

        $idValues = implode(',', array_column($forFeeUpdate, $idColumn));

        $query = "UPDATE tbl_billing_details_temp SET total_fees = (CASE {$idColumn} {$caseStatements} END) WHERE {$idColumn} IN ({$idValues})";

        DB::statement($query);

        Log::info('Updated fees for students ' & $idValues);
    }
}
