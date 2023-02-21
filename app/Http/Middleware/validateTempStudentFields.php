<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class validateTempStudentFields
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
        $tempstudents =  json_decode($request->payload, true); //json decode into array (the second parameter)
        if (count($tempstudents) < 1) return response('Invalid', 400);
        foreach ($tempstudents as $tempstudent)
            if ($this->validateTempStudentFields($tempstudent) == FALSE) return response('Invalid', 400);
        return $next($request);
    }

    private function validateTempStudentFields($tempstudent)
    {
        $validator = Validator::make((array) $tempstudent, [
            'last_name' => 'required|max:255',
            'given_name' => 'required|max:255',
            'sex_at_birth' => 'required|max:25',
            'birthdate' => 'required|date_format:Y-m-d',
            'birthplace' => 'required|max:255',
            'mothers_gname' => 'required|max:255', //mother madien fname
            'mothers_lname' => 'required|max:255', //mother madien lname
            'pres_prov' => 'required|max:255',
            'pres_city' => 'required|max:255',
            'pres_brgy' => 'required|max:255',
            'pres_zip' => 'required|max:255',
            'perm_prov' => 'required|max:255',
            'perm_city' => 'required|max:255',
            'perm_brgy' => 'required|max:255',
            'perm_zip' => 'required|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|regex:/^(9)\d{9}$/'
            // 'degree_program' => 'required|max:255'
        ]);

        //return validator failure status
        return $validator->fails();
    }
}
