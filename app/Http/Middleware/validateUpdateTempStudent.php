<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;

class validateUpdateTempStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'edit_last_name' => 'required', //modal field name => validation
            'edit_first_name' => 'required',
            'edit_birthplace' => 'required',
            'edit_present_province' => 'required',
            'edit_present_city' => 'required',
            'edit_present_barangay' => 'required',
            'edit_present_zipcode' => 'required',
            'edit_permanent_province' => 'required',
            'edit_permanent_city' => 'required',
            'edit_permanent_barangay' => 'required',
            'edit_permanent_zipcode' => 'required',
            'edit_email_address' => 'required|email',
            'edit_mobile_number' => 'required|regex:/^(09)\d{9}$/',
            'edit_course_enrolled' => 'required',
            'edit_year_level' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        return $next($request);
    }
}
