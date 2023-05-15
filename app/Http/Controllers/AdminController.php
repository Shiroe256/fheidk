<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Billing;
use App\Models\Hei;
use App\Models\OtherSchoolFees;
use App\Models\TemporaryBilling;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function form3()
    {
        return view('admin.form3');
    }

    // public function managebillinglist(){
    //     return view('admin.manage-billing-list');
    // }

    public function manageuserslist()
    {
        return view('admin.manage-users-list');
    }

    public function managebillinglist()
    {
        return view('admin.manage-billing-list');
    }


    public function managebillinglistsearch(Request $request)
    {
        $acYear = $request->input('ac_year');
        $semester = $request->input('semester');
        $billingStatus = $request->input('billing_status');

        // Query the database to retrieve the data based on the selected values
        $billings = Billing::where(function ($query) use ($acYear) {
            if ($acYear != 'All') {
                // $query->where('ac_year', '=', $acYear);
                $query->where('ac_year', '=', $acYear);
            }
        })
            ->where(function ($query) use ($semester) {
                if ($semester != 'All') {
                    $query->where('semester', '=', $semester);
                }
            })
            ->where(function ($query) use ($billingStatus) {
                if ($billingStatus != 'All') {
                    $query->where('billing_status', '=', $billingStatus);
                }
            })
            ->get();

        $output = '';
        if ($billings->count() > 0) {
            $output .= ' <table class="table table-bordered my-0" id="tbl_manage_billing_list">
                <thead>
                    <tr>
                        <th>REGION</th>
                        <th>HEI NAME</th>
                        <th>REFERENCE NO.</th>
                        <th class="text-right">BENEFICIARIES</th>
                        <th class="text-right">AMOUNT</th>
                        <th>STATUS</th>
                        <th class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody id ="">';
            foreach ($billings as $billing) {
                $output .= '<tr>
                        <td>' . $billing->hei->hei_region_nir . '</td>
                        <td>' . $billing->hei->hei_name . '</td>
                        <td>' . $billing->reference_no . '</td>
                        <td class="text-right">' . $billing->total_beneficiaries . '</td>
                        <td class="text-right">' . $billing->total_amount . '</td>
                        <td>';

                if ($billing->billing_status == 1) {
                    $output .= '<span class="badge badge-pill badge-secondary span-size">Open for Billing Uploads</span>';
                } elseif ($billing->billing_status == 2) {
                    $output .= '<span class="badge badge-pill badge-info span-size">Ongoing Validation, please return once done</span>';
                } elseif ($billing->billing_status == 3) {
                    $output .= '<span class="badge badge-pill badge-primary span-size">Done Validating: Ready For Submission</span>';
                } elseif ($billing->billing_status == 4) {
                    $output .= '<span class="badge badge-pill badge-danger span-size">Done Validating: For Review</span>';
                } elseif ($billing->billing_status == 5) {
                    $output .= '<span class="badge badge-pill badge-warning span-size">Submitted to UniFAST: Billing Unit</span>';
                } elseif ($billing->billing_status == 6) {
                    $output .= '<span class="badge badge-pill badge-warning span-size">Submitted to UniFAST: Admin Unit</span>';
                } elseif ($billing->billing_status == 7) {
                    $output .= '<span class="badge badge-pill badge-warning span-size">Submitted to CHED-AFMS</span>';
                } elseif ($billing->billing_status == 8) {
                    $output .= '<span class="badge badge-pill badge-success span-size">Disbursed</span>';
                }

                $output .= '</td>
                        <td>
                            <a href="' . route("managebillingpage", $billing->reference_no) . '" id="' . $billing->uid . '" name="btn-view-billing" class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button"><i class="fas fa-eye"></i>View</a>
                        </td>
                    </tr>';
            }
            $output .= ' </tbody>
                <tfoot>
                    <tr>
                        <td><strong>REGION</strong><br></td>
                        <td><strong>HEI NAME</strong><br></td>
                        <td><strong>REFERENCE NO.</strong><br></td>
                        <td class="text-right"><strong>BENEFICIARIES</strong></td>
                        <td class="text-right"><strong>AMOUNT</strong></td>
                        <td><strong>STATUS</strong></td>
                        <td class="text-center"><strong>ACTION</strong></td>
                    </tr>
                </tfoot>
            </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No billing records.</h1>';
        }
    }

    public function managebillingpage($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('reference_no', $reference_no)->first();

        $data['billing'] = $billing;
        return view('admin.manage-billing-page', $data);
    }

    public function form1($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('reference_no', $reference_no)->first();

        $data['billing'] = $billing;

        return view('admin.form1', $data);
    }

    public function form2($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('reference_no', $reference_no)->first();
        $students = TemporaryBilling::where('reference_no', $reference_no)->get();

        $data = [
            'billing' => $billing,
            'students' => $students,
        ];

        return view('admin.form2', $data);
    }

    public function manageuserpage($hei_uii)
{
    // Retrieve the corresponding Hei model from the database
    $heis = Hei::where('hei_uii', $hei_uii)->first();

    // Check if the Hei model exists
    if (!$heis) {
        abort(404);
    }

    // Pass the $heis variable to the view
    return view('admin.manage-users-page', ['heis' => $heis]);
}

    public function fetchbillinglist()
    {
        $billings = Billing::all();
        $data['billings'] = $billings;
        return view('admin.elements.billinglist', $data);
    }


    public function fetchtosflist(Request $request)
    {
        $hei_uii = $request->hei_uii;
        $fees = OtherSchoolFees::where('hei_uii', $hei_uii)
            ->get();
        $data['fees'] = $fees;
        return view('admin.elements.tosflist', $data);
    }

    public function fetchuserlist()
    {
        $heis = Hei::where('hei_it', 'LUC')
            ->where('fhe_benefits', 1)
            ->get();
        $data['heis'] = $heis;
        return view('admin.elements.userlist', $data);
    }

    // handle insert a new fee ajax request
    public function newfee(Request $request)
    {
        $fee = [
            'ac_year' => '2021-2025',
            'hei_psg_region' => $request->add_tosf_hei_psg_region,
            'hei_uii' => $request->add_tosf_hei_uii,
            'hei_name' => $request->add_tosf_hei_name,
            'year_level' => $request->add_tosf_year_level,
            'semester' => $request->add_tosf_semester,
            'course_enrolled' => $request->add_tosf_degree_program,
            'type_of_fee' => $request->add_tosf_type_of_fee,
            'category' => $request->add_tosf_category,
            'coverage' => $request->add_tosf_coverage,
            'amount' => $request->add_tosf_amount  
        ];
        OtherSchoolFees::create($fee);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an student ajax request
    public function editfee(Request $request)
    {
        $id = $request->uid;
        $fee = OtherSchoolFees::find($id);
        return response()->json($fee);
    }

    // handle update an student ajax request
    public function updatefee(Request $request)
    {
        //!validation transferred to middleware
        $fee = OtherSchoolFees::find($request->update_tosf_id);
        $feeData = [
            //actual data being collected in the modal
            'year_level' => $request->update_tosf_year_level,
            'semester' => $request->update_tosf_semester,
            'course_enrolled' => $request->update_tosf_program,
            'type_of_fee' => $request->update_tosf_type_of_fee,
            'category' => $request->update_tosf_category,
            'coverage' => $request->update_tosf_coverage,
            'amount' => $request->update_tosf_amount  
        ];
        $fee->update($feeData);
        return response()->json([
            'status' => 200,
        ]);
    }

    //handles delete student information
    public function deletefee(Request $request)
    {
        $id = $request->uid;
        // $students = TemporaryBilling::find($id);
        $fees = OtherSchoolFees::whereIn('uid', $id);
        $fees->delete();
    }

}
