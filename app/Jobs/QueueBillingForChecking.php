<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\TemporaryBilling;
use App\Models\Student;
use App\Models\EnrollmentInfo;
use App\Models\Billing;
use Illuminate\Support\Facades\Log;

class QueueBillingForChecking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $reference_no;
    public function __construct($reference_no)
    {
        $this->reference_no = $reference_no;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reference_no = $this->reference_no;
        //when the billing has been checked. Save it with a new status.

        //set billing status but not save it yet. IF there are no errors ayun

        //get students of each billing transaction
        $students = TemporaryBilling::where('reference_no', $reference_no)->get();
        // echo $students;

        $billing = Billing::where('reference_no', $reference_no)->first();
        //check each student in billing transaction for duplciates in fhe award number
        $billing->billing_status = 3; //3 is done queue
        foreach ($students as $student) {
            // select student for later updates
            // $student = TemporaryBilling::find($student['uid']);
            // get student and enrollment info
            $remarks = '';

            //fetch duplicates in the masterlist
            $duplicateinmasterlist = Student::where('fname', $student->stud_fname)
                ->where('lname', $student->stud_lname)
                ->where('birthdate', $student->stud_birth_date)
                ->first();

            //if there are duplicates in the masterlist add a remark
            if ($duplicateinmasterlist != null) {
                printf('meron');
                $fhe_award_no = $duplicateinmasterlist->fhe_award_no;
                $student->fhe_award_no = $fhe_award_no;
                $studentinfo = Student::where('fhe_award_no', $fhe_award_no)->first();
                // $remarks .= 'FHE award no. automatically selected from Master table</br>';

                if ($studentinfo == null) {
                    continue;
                }

                $enrollmentinfo = EnrollmentInfo::where('app_id', $studentinfo->app_id)->orderBy('ac_year')->orderBy('semester')->get();
                $firstyear = (float) $enrollmentinfo->first()->ac_year;
                $firstsem = (float) $enrollmentinfo->first()->semester;
                $loainfo = EnrollmentInfo::where('status', 2)->orderBy('ac_year')->orderBy('semester')->get(); //LOA
                $nstpunits = $enrollmentinfo->sum('nstp_unit');
                //if there are any duplicates for this semester
                if ($studentinfo->count() > 0) {
                    //compute nstp units
                    if ($nstpunits >= 6) {
                        $remarks .= '<span class="badge badge-secondary">NSTP</span>';
                    }

                    foreach ($enrollmentinfo as $key => $enrollmenti) {

                        if ($enrollmenti->ac_year == $billing->ac_year && $enrollmenti->semester == $billing->semester) {
                            $remarks .= '<span class="badge badge-warning">Duplicate</span>';
                            if ($enrollmenti->hei_uii <> $billing->hei_uii) {
                                $remarks .= '<span class="badge badge-Dark">Duplicate HEI</span>';
                            }
                        }
                    }

                    //maximum residency start
                    //we have yet to get a database of the duration of courses
                    // $normal_length = $this->getCourseLength($this->getCourseUid($billing->hei_uii, $student->degree_program));
                    $normal_length = 4;
                    $firstsem_discrepancy = $firstsem > 1 ? 0.5 : 0;
                    $lastsem_discrepancy = (float) $billing->semester > 1 ? 0 : 0.5;
                    $length = (float) $billing->ac_year - (float) $firstyear; //count the number of years since it is half of the number of semesters
                    $totallength = $length - $loainfo->count() / 2 - $firstsem_discrepancy + $lastsem_discrepancy;
                    if ($totallength > $normal_length) {
                        //added badge
                        // $remarks .= '<span class="badge badge-danger">' . strval($totallength) . '</span>';
                        $remarks .= '<span class="badge badge-warning">Exceeded MRR</span>';
                    }
                    //maximum residency end
                }
            }
            //duplicates in table and from other schools also
            $duplicates = TemporaryBilling::where('stud_fname', $student->stud_fname)->where('stud_lname', $student->stud_lname)->where('stud_birth_date', $student->stud_birth_date)->count();
            if ($duplicates > 1) {
                $remarks .= '<span class="badge badge-danger">Duplicate</span>';
            }

            if ($remarks != '') {
                $billing->billing_status = 4;
            }
            printf('remarks: ' . $remarks);
            $student->remarks = $remarks;
            $student->save();
        }
        echo "billing done";
        $billing->save();

        //write a success message in the logs
        // Log::info('Billing Transaction with reference number ' . $this->reference_no . ' has been processed');
    }
}
