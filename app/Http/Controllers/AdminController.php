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

        return view('admin.manage-billing-list', compact('billings'));
    }
}
