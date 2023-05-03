<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Billing;
use App\Models\TemporaryBilling;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OtherSchoolFeesImport;
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
                        <a href="' . route("managebillingpage", $billing->reference_no) . '" id="' . $billing->uid . '" name="btn_view_billing" class="btn btn-outline-info btn-block btn-sm border rounded-pill" role="button"><i class="fas fa-eye"></i>View</a>
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

// public function import(Request $request)
// {
//     // Validate the uploaded file
//     $validator = Validator::make($request->all(), [
//         'file' => 'required|mimes:xlsx,xls,csv'
//     ]);

//     // If validation fails, redirect back with errors
//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator);
//     }

//     // Load the uploaded file using PHPSpreadsheet
//     $filePath = $request->file('file')->getRealPath();
//     $spreadsheet = IOFactory::load($filePath);

//     // Get the first worksheet of the uploaded file
//     $worksheet = $spreadsheet->getActiveSheet();

//     // Loop through the rows of the worksheet and insert the data into the database
//     foreach ($worksheet->getRowIterator() as $row) {
//         $data = [];
//         foreach ($row->getCellIterator() as $cell) {
//             $data[] = $cell->getValue();
//         }

//         DB::table('tbl_other_school_fees')->insert([
//             'ac_year' => $data[1],
//             'hei_psg_region' => $data[2],
//             'hei_uii' => $data[3],
//             'hei_name' => $data[4],
//             'year_level' => $data[5],
//             'semester' => $data[6],
//             'course_enrolled' => $data[7],
//             'type_of_fee' => $data[8],
//             'category' => $data[9],
//             'coverage' => $data[10],
//             'is_optional' => $data[12],
//             'amount' => $data[11],
//         ]);
//     }

//     return redirect()->back()->with('success', 'File uploaded successfully.');
// }


public function import(Request $request)
{
    // Validate the uploaded file
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    // If validation fails, redirect back with errors
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
    }

    // Load the uploaded file using PHPSpreadsheet
    $filePath = $request->file('file')->getRealPath();
    $spreadsheet = IOFactory::load($filePath);

    // Get the first worksheet of the uploaded file
    $worksheet = $spreadsheet->getActiveSheet();

    // Loop through the rows of the worksheet and insert the data into the database
    foreach ($worksheet->getRowIterator() as $row) {
        $data = [];
        foreach ($row->getCellIterator() as $cell) {
            $data[] = $cell->getValue();
        }

        DB::table('tbl_other_school_fees')->insert([
            'ac_year' => $data[0],
            'hei_psg_region' => $data[1],
            'hei_uii' => $data[2],
            'hei_name' => $data[3],
            'year_level' => $data[4],
            'semester' => $data[5],
            'course_enrolled' => $data[6],
            'type_of_fee' => $data[7],
            'category' => $data[8],
            'coverage' => $data[9],
            'is_optional' => $data[11],
            'amount' => $data[10],
        ]);
    }

    return redirect()->back()->with('success', 'File uploaded successfully.');
}

}
