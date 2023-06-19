<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Billing;
use App\Models\Hei;
use App\Models\OtherSchoolFees;
use App\Models\TemporaryBilling;
use App\Models\StudentDetails;
use App\Models\BillingForm2;
use App\Models\BillingForm3;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function admindashboard()
    {
        return view('admin.dashboard');
    }

    public function manageuserslist()
    {
        return view('admin.manage-users-list');
    }

    public function managebillinglist()
    {
        return view('admin.manage-billing-list');
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

        // Calculate the total amount
        $totalAmount = TemporaryBilling::sum('total_fees');

        $data['billing'] = $billing;
        $data['totalAmount'] = $totalAmount;

        return view('admin.form1', $data);
    }

    public function form2($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = Billing::where('reference_no', $reference_no)->first();

        $data['billing'] = $billing;

        return view('admin.form2', $data);
    }

    public function fetchform2list(Request $request)
    {
        $reference_no = $request->reference_no;

        $students = BillingForm2::where('reference_no', $reference_no)->get();
        $data['students'] = $students;
        return view('admin.elements.form2list', $data);
    }

    public function form3($reference_no)
    {
        // Query the database to retrieve the data based on the selected values
        $billing = BillingForm3::where('reference_no', $reference_no)->first();

        $data['billing'] = $billing;

        return view('admin.form3', $data);
    }

    public function fetchform3list(Request $request)
    {
        $reference_no = $request->reference_no;

        $students = TemporaryBilling::where('reference_no', $reference_no)
            ->whereNotNull('total_exam_taken')->get();
        $data['students'] = $students;
        return view('admin.elements.form3list', $data);
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

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Load the uploaded file using PHPSpreadsheet
        $filePath = $request->file('file')->getRealPath();
        $ac_year = "2021-2026";
        $hei_uii = $request->upload_tosf_hei_uii;
        $hei_psg_region = $request->upload_tosf_hei_psg_region;
        $hei_name = $request->upload_tosf_hei_name;

        $spreadsheet = IOFactory::load($filePath);

        // Get the first worksheet of the uploaded file
        $worksheet = $spreadsheet->getActiveSheet();

        // Initialize a flag to indicate whether the current row is the header row
        $isHeaderRow = true;

        // Set the batch size
        $batchSize = 1000;

        // Get the highest row number in the worksheet
        $highestRow = $worksheet->getHighestRow();

        // Loop through the rows of the worksheet and insert the data into the database in batches
        for ($i = 1; $i <= $highestRow; $i += $batchSize) {
            $batch = [];
            for ($j = $i; $j < $i + $batchSize; $j++) {
                if ($j > $highestRow) {
                    break;
                }
                $row = $worksheet->getRowIterator($j)->current();

                if ($isHeaderRow) {
                    // Skip the header row
                    $isHeaderRow = false;
                    continue;
                }

                $data = [];
                foreach ($row->getCellIterator() as $cell) {
                    $data[] = $cell->getValue();
                }
                // Validate the data before creating the record
                $validator = Validator::make($data, [
                    'year_level' => 'numeric',
                    'semester' => 'numeric',
                    'amount' => 'numeric',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $batch[] = [
                    'ac_year' => $ac_year,
                    'hei_psg_region' => $hei_psg_region,
                    'hei_uii' => $hei_uii,
                    'hei_name' => $hei_name,
                    'year_level' => $data[4],
                    'semester' => $data[5],
                    'course_enrolled' => $data[6],
                    'type_of_fee' => $data[7],
                    'category' => $data[8],
                    'coverage' => $data[9],
                    'amount' => $data[10],
                ];
            }
            OtherSchoolFees::insert($batch);
        }
        return response()->json([
            'status' => 200,
        ]);
        return view('admin.elements.tosflist');
    }

    public function openbilling(Request $request)
    {
        // Query the database to retrieve the data based on the selected values
        $heis = Hei::where('fhe_benefits', 1)->get();

        $newBilling = [];
        $existingReferences = [];

        foreach ($heis as $data) {
            $reference_no = $data->hei_psg_region . '-' . $data->hei_uii . '-' . $request->open_billing_ac_year . '-' . $request->open_billing_semester;

            // Check if the reference number already exists in the Billing table
            $existingBilling = Billing::where('reference_no', $reference_no)->first();

            if (!$existingBilling) {
                $newBilling[] = [
                    'hei_psg_region' => $data->hei_psg_region,
                    'hei_sid' => $data->hei_sid,
                    'hei_uii' => $data->hei_uii,
                    'reference_no' => $reference_no,
                    'ac_year' => $request->open_billing_ac_year,
                    'semester' => $request->open_billing_semester,
                    'billing_status' => 1,
                ];
            } else {
                $existingReferences[] = [
                    'reference_no' => $reference_no,
                    'hei_name' => $data->hei_name,
                ];
            }
        }

        if (!empty($newBilling)) {
            Billing::insert($newBilling);
        }

        $response = [
            'status' => 200,
            // 'data' => $newBilling
        ];

        if (!empty($existingReferences)) {
            $message = 'The following reference number(s) already exist:<br>';
            foreach ($existingReferences as $index => $reference) {
                $message .= ($index + 1) . '. ' . $reference['reference_no'] . ' - ' . $reference['hei_name'] . '<br>';
            }
            $response['message'] = $message;
        }

        return response()->json($response);
    }
}
