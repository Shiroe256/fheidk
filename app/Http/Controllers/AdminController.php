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

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Load the uploaded file using PHPSpreadsheet
        $filePath = $request->file('file')->getRealPath();
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
                    'is_optional' => 'numeric|in:0,1',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $batch[] = [
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
                    'amount' => $data[10],
                    'is_optional' => $data[11],
                ];
            }
            OtherSchoolFees::insert($batch);
        }
        return response()->json([
            'status' => 200,
        ]);
        return view('admin.elements.tosflist');
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

    // handle insert a new student ajax request
    public function newTempStudent(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'last_name' => 'required', //modal field name => validation
        //     'first_name' => 'required',
        //     'birthplace' => 'required',
        //     'present_province' => 'required',
        //     'present_city' => 'required',
        //     'present_barangay' => 'required',
        //     'present_zipcode' => 'required',
        //     'permanent_province' => 'required',
        //     'permanent_city' => 'required',
        //     'permanent_barangay' => 'required',
        //     'permanent_zipcode' => 'required',
        //     'email_address' => 'required|email',
        //     'mobile_number' => 'required|regex:/^(09)\d{9}$/',
        //     'course_enrolled' => 'required',
        //     'year_level' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => $validator->messages(),
        //     ]);
        // } else {
        $total_computer_fee = $request->computer_fee_per_unit_amount + $request->computer_fee;
        $students = [
            //static sample data
            'hei_psg_region' => $request->add_hei_psg_region,
            'hei_sid' => Auth::user()->hei_sid,
            'hei_uii' => $request->add_hei_uii,
            'hei_name' => $request->add_selected_campus,
            'reference_no' => $request->add_reference_no,
            'ac_year' => $request->add_ac_year,
            'semester' => $request->add_semester,
            'tranche' => $request->add_tranche,
            'app_id' => '',
            'fhe_award_no' => '',
            'stud_id' => $request->stud_id,
            'lrn_no' => $request->lrn_no,
            //actual data being collected in the modal
            'stud_lname' => $request->last_name, //tablename => $request->name of input field
            'stud_fname' => $request->first_name,
            'stud_mname' => $request->middle_name,
            'stud_ext_name' => $request->extension_name,
            'stud_sex' => $request->sex,
            'stud_birth_date' => $request->birthdate,
            'stud_birth_place' => $request->birthplace,
            'f_lname' => $request->f_lname,
            'f_fname' => $request->f_fname,
            'f_mname' => $request->f_mname,
            'm_lname' => $request->m_lname,
            'm_fname' => $request->m_fname,
            'm_mname' => $request->m_mname,
            'present_prov' => $request->present_province,
            'present_city' => $request->present_city,
            'present_barangay' => $request->present_barangay,
            'present_street' => $request->present_street,
            'present_zipcode' => $request->present_zipcode,
            'permanent_prov' => $request->permanent_province,
            'permanent_city' => $request->permanent_city,
            'permanent_barangay' => $request->permanent_barangay,
            'permanent_street' => $request->permanent_street,
            'permanent_zipcode' => $request->permanent_zipcode,
            'stud_email' => $request->email_address,
            'stud_alt_email' => $request->alt_email_address,
            'stud_phone_no' => $request->mobile_number,
            'stud_alt_phone_no' => $request->alt_mobile_number,
            //static
            'transferee' => $request->checkbox_transferee,
            'degree_program' => $request->degree_program,
            'year_level' => $request->year_level,
            'lab_unit' => $request->laboratory_units,
            'comp_lab_unit' => $request->computer_fee_per_unit,
            'academic_unit' => $request->total_unit,
            'nstp_unit' => $request->nstp_unit,
            'tuition_fee' => $request->total_tuition,
            'entrance_fee' => $request->entrance_fee,
            'admission_fee' => $request->admission_fee,
            'athletic_fee' => $request->athletic_fee,
            'computer_fee' => $total_computer_fee,
            'cultural_fee' => $request->cultural_fee,
            'development_fee' => $request->development_fee,
            'guidance_fee' => $request->guidance_fee,
            'handbook_fee' => $request->handbook_fee,
            'laboratory_fee' => $request->laboratory_fee,
            'library_fee' => $request->library_fee,
            'medical_dental_fee' => $request->medical_dental_fee,
            'registration_fee' => $request->registration_fee,
            'school_id_fee' => $request->school_id_fee,
            'nstp_fee' => $request->total_nstp,
            'stud_cor' => 'sample',
            'remarks' => $request->remarks
        ];
        OtherSchoolFees::create($students);
        return response()->json([
            'status' => 200,
        ]);
        // }
    }
}
