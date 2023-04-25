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
        return view('admin.manage-billing-list');
    }

    public function fetchbillinglist()
    {
        $billings = Billing::all();

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
                        <a href="' . route("fetchbillingpage", $billing->uid) . '" id="' . $billing->uid . '" name="btn_view_billing" class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button"><i class="fas fa-eye"></i>View</a>
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
                            <a href="' . route("fetchbillingpage", $billing->uid) . '" id="' . $billing->uid . '" name="btn-view-billing" class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button"><i class="fas fa-eye"></i>View</a>
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

    public function fetchbillingpage(Request $request, $uid)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('uid', $uid)->first();
        return redirect()->route('admin.manage-billing-page', $billing->uid);
    }

    // public function fetchbillingpage(Request $request)
    // {
    //     $billing_record_id = $request->uid;

    //     // Query the database to retrieve the data based on the selected values
    //     $billings = Billing::where('uid', $billing_record_id)
    //         ->get();
    //     $data['billings'] = $billings;
    //     return view('admin.manage-billing-page', $data);
    //     // $output = '';
    //     // if ($billings->count() > 0) {
    //     //     $output .= ' <table class="table table-bordered table-bordered">
    //     //     <thead>
    //     //         <tr>
    //     //             <th>BILLING DOCUMENTS</th>
    //     //             <th>STATUS</th>
    //     //             <th>REMARKS</th>
    //     //             <th class="text-center">ACTION</th>
    //     //         </tr>
    //     //     </thead>
    //     //     <tbody>';
    //     //     foreach ($billings as $billing) {
    //     //         $output .= '<tr>
    //     //                 <td>' . $billing->hei->hei_region_nir . '</td>
    //     //                 <td>' . $billing->hei->hei_name . '</td>
    //     //                 <td>' . $billing->reference_no . '</td>
    //     //                 <td class="text-right">' . $billing->total_beneficiaries . '</td>
    //     //                 <td class="text-right">' . $billing->total_amount . '</td>
    //     //                 <td>';

    //     //         if ($billing->billing_status == 1) {
    //     //             $output .= '<span class="badge badge-pill badge-secondary span-size">Open for Billing Uploads</span>';
    //     //         } elseif ($billing->billing_status == 2) {
    //     //             $output .= '<span class="badge badge-pill badge-info span-size">Ongoing Validation, please return once done</span>';
    //     //         } elseif ($billing->billing_status == 3) {
    //     //             $output .= '<span class="badge badge-pill badge-primary span-size">Done Validating: Ready For Submission</span>';
    //     //         } elseif ($billing->billing_status == 4) {
    //     //             $output .= '<span class="badge badge-pill badge-danger span-size">Done Validating: For Review</span>';
    //     //         } elseif ($billing->billing_status == 5) {
    //     //             $output .= '<span class="badge badge-pill badge-warning span-size">Submitted to UniFAST: Billing Unit</span>';
    //     //         } elseif ($billing->billing_status == 6) {
    //     //             $output .= '<span class="badge badge-pill badge-warning span-size">Submitted to UniFAST: Admin Unit</span>';
    //     //         } elseif ($billing->billing_status == 7) {
    //     //             $output .= '<span class="badge badge-pill badge-warning span-size">Submitted to CHED-AFMS</span>';
    //     //         } elseif ($billing->billing_status == 8) {
    //     //             $output .= '<span class="badge badge-pill badge-success span-size">Disbursed</span>';
    //     //         }

    //     //         $output .= '</td>
    //     //                 <td>
    //     //                     <a href="' . route("managebillingpage", $billing->uid) . '" class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button"><i class="fas fa-eye"></i>View</a>
    //     //                 </td>
    //     //             </tr>';
    //     //     }
    //     //     $output .= ' </tbody>
    //     //         <tfoot>
    //     //             <tr>
    //     //                 <td><strong>REGION</strong><br></td>
    //     //                 <td><strong>HEI NAME</strong><br></td>
    //     //                 <td><strong>REFERENCE NO.</strong><br></td>
    //     //                 <td class="text-right"><strong>BENEFICIARIES</strong></td>
    //     //                 <td class="text-right"><strong>AMOUNT</strong></td>
    //     //                 <td><strong>STATUS</strong></td>
    //     //                 <td class="text-center"><strong>ACTION</strong></td>
    //     //             </tr>
    //     //         </tfoot>
    //     //     </table>';
    //     //     echo $output;
    //     // } else {
    //     //     echo '<h1 class="text-center text-secondary my-5">No billing records.</h1>';
    //     // }
    // }
}
