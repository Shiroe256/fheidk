<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class validateNewTempStudent
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
            'last_name' => 'required', //modal field name => validation
            'first_name' => 'required',
            'birthplace' => 'required',
            'present_province' => 'required',
            'present_city' => 'required',
            'present_barangay' => 'required',
            'present_zipcode' => 'required',
            'permanent_province' => 'required',
            'permanent_city' => 'required',
            'permanent_barangay' => 'required',
            'permanent_zipcode' => 'required',
            'email_address' => 'required|email',
            'mobile_number' => 'required|regex:/^(09)\d{9}$/',
            'course_enrolled' => 'required',
            'year_level' => 'required'
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
