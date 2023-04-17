<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Billing;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function form1()
    {
        return view('admin.form1');
    }

    public function form2()
    {
        return view('admin.form2');
    }

    public function form3()
    {
        return view('admin.form3');
    }

    // public function managebillinglist(){
    //     return view('admin.manage-billing-list');
    // }

    public function managebillingpage()
    {
        return view('admin.manage-billing-page');
    }

    public function manageuserslist()
    {
        return view('admin.manage-users-list');
    }

    public function manageuserpage()
    {
        return view('admin.manage-users-page');
    }

    public function managebillinglist()
    {
        $billings = Billing::all();

        return view('admin.manage-billing-list', compact('billings'));
    }

    public function search(Request $request)
    {
        $acYear = $request->input('ac_year');
        $semester = $request->input('semester');
        $billingStatus = $request->input('billing_status');

        // Query the database to retrieve the data based on the selected values
        $billings = Billing::where(function ($query) use ($acYear) {
            if ($acYear != 'All') {
                // $query->where('ac_year', '=', $acYear);
                $query->where('ac_year', '=', '2021-2022');
            }
        })
            ->where(function ($query) use ($semester) {
                if ($semester != 'All') {
                    $query->where('semester', '=', 1);
                }
            })
            ->where(function ($query) use ($billingStatus) {
                if ($billingStatus != 'All') {
                    $query->where('billing_status', '=', 3);
                }
            })
            ->get();

        return view('admin.manage-billing-list', compact('billings'));
    }

    // public function fetchTempApplicants(Request $request)
    // {
    //     $applicants = Billing::orderBy('remarks')
    //         ->where('reference_no', $reference_no)
    //         ->whereNotNull('total_exam_taken')
    //         ->get();
    //     $output = '';
    //     if ($applicants->count() > 0) {
    //         $output .= ' <table class="table table-bordered table-hover table-sm dataTable my-0 table-style"
    //         id="tbl_applicants">
    //         <thead>
    //             <tr>
    //                 <th class="text-center"><input type="checkbox"></th>
    //                 <th class="text-left">HEI CAMPUS</th>
    //                 <th class="text-left">APP ID</th>
    //                 <th class="text-left">LASTNAME</th>
    //                 <th class="text-left">FIRSTNAME</th>
    //                 <th class="text-left">MIDDLENAME</th>
    //                 <th>COURSE</th>
    //                 <th class="text-center">YEAR</th>
    //                 <th class="text-left">REMARKS</th>
    //                 <th class="text-center">NO. OF EXAM TAKEN</th>
    //                 <th class="text-left">RESULT</th>
    //                 <th class="text-center">ACTION</th>
    //             </tr>
    //         </thead>
    //         <tbody id="tbl_list_of_students_form_3">';
    //         foreach ($applicants as $applicant) {
    //             $output .= '<tr>
    //                 <td class="text-center"><input type="checkbox" id="' . $applicant->uid . '" name="applicant_checkbox" value="' . $applicant->uid . '"></td>
    //                 <td class="text-left">' . $applicant->hei_name . '</td>
    //                 <td class="text-left">' . $applicant->app_id . '</td>
    //                 <td>' . $applicant->stud_lname . '</td>
    //                 <td>' . $applicant->stud_fname . '</td>
    //                 <td>' . $applicant->stud_mname . '</td>
    //                 <td>' . $applicant->degree_program . '</td>
    //                 <td class="text-center">' . $applicant->year_level . '</td>
    //                 <td class="text-left">' . $applicant->transferee . '</td>
    //                 <td class="text-center">' . $applicant->total_exam_taken . '</td>
    //                 <td class="text-left">' . $applicant->exam_result . '<br></td>
    //                 <td class="text-center">
    //                     <div class="btn-group btn-group-sm" role="group">
    //                         <button id="' . $applicant->uid . '" class="btn btn_update_student btn-outline-primary" data-bs-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Applicant Information" data-bs-target="#mod_admission_entrance"><i class="far fa-edit"></i>
    //                         </button>
    //                     </div>
    //                 </td>
    //             </tr>';
    //         }
    //         $output .= '</tbody>
    //         </table>';
    //         echo $output;
    //     } else {
    //         echo '<h1 class="text-center text-secondary my-5">No applicant records.</h1>';
    //     }
    // }
}