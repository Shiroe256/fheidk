<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pagescontroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function listofbillings(){
        return view('listofbillings');
    }

    public function billingmanagement(){
        return view('billingmanagement');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function profile(){
        return view('profile');
    }

    public function registers(){
        return view('registers');
    }

    // public function contactus(){
    //     return view('contactus');
    // }

    // public function aboutus(){
    //     return view('aboutus');
    // }
}
