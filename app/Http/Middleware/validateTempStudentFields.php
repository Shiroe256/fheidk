<?php

namespace App\Http\Middleware;

use App\Models\OtherSchoolFees;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $payload = json_decode($request->payload);

        $trimmedPayload = collect($payload)->map(function ($value) {
            if (is_string($value)) {
                return trim($value);
            }
            return $value;
        })->all();

        $request->merge(['payload' => $trimmedPayload]);

        $hei_uii = Auth::user()->hei_uii;
        $tempstudents =  $request->payload; //json decode into array (the second parameter)
        $courses = array_values(OtherSchoolFees::select('course_enrolled')->where('hei_uii', $hei_uii)->groupBy('hei_uii', 'course_enrolled')->get()->toArray());
        if (count($tempstudents) < 1) return response('Invalid', 400);
        foreach ($tempstudents as $key => $tempstudent) {
            $error = $this->validateTempStudentFields($tempstudent);
            if (count($error) > 0) return response('Invalid Input in ' . array_keys($error)[0] . ' in Row ' . $key + 1, 400);
            if (in_array($tempstudent->degree_course_id, $courses)) return response('Invalid Course in Row ' . $key + 1, 400);
        }
        return $next($request);
    }

    private function validateTempStudentFields($tempstudent)
    {
        $validator = Validator::make((array) $tempstudent, [
            'last_name' => ['required', 'max:255', 'regex:/^(?!^\s+)(?!.*\s$)[A-Za-zÑñ\s.-]+$/'],
            'given_name' => ['required', 'max:255', 'regex:/^(?!^\s+)(?!.*\s$)[A-Za-zÑñ\s.-]+$/'],
            'sex_at_birth' => ['required', 'max:25', 'regex:/^(male|Male|Female|female|MALE|FEMALE)$/'],
            // 'birthdate' => ['required', 'date_format:mm-dd-yyyy'],
            // 'birthplace' => ['required', 'max:255', 'regex:/^[a-zA-Z][a-zA-ZÑñ\s\'-.]*$/'],
            'mothers_gname' => ['required', 'max:255', 'regex:/^(?!^\s+)(?!.*\s$)[A-Za-zÑñ\s.-]+$/'], //mother madien fname
            'mothers_lname' => ['required', 'max:255', 'regex:/^(?!^\s+)(?!.*\s$)[A-Za-zÑñ\s.-]+$/'], //mother madien lname
            'pres_prov' => ['required', 'max:255', 'regex:/^[a-zA-Z][a-zA-ZÑñ\s\'-.]*$/'],
            'pres_city' => ['required', 'max:255', 'regex:/^[a-zA-Z][a-zA-ZÑñ\s\'-.]*$/'],
            'pres_brgy' => ['required', 'max:255', 'regex:/^[a-zA-Z][a-zA-ZÑñ0-9\s\'-.]*$/'],
            'pres_zip' => ['required', 'max:255', 'regex:/^[1-9]\d{3}$/'],
            'perm_prov' => ['required', 'max:255', 'regex:/^[a-zA-Z][a-zA-ZÑñ\s\'-.]*$/'],
            'perm_city' => ['required', 'max:255', 'regex:/^[a-zA-Z][a-zA-ZÑñ\s\'-.]*$/'],
            'perm_brgy' => ['required', 'max:255', 'regex:/^[a-zA-Z][a-zA-ZÑñ0-9\s\'-.]*$/'],
            'perm_zip' => ['required', 'max:255', 'regex:/^[1-9]\d{3}$/'],
            'email' => ['required', 'email', 'max:255'],
            'contact_number' => ['required', 'regex:/^(9)\d{9}$/']
            // 'degree_program' => 'required|max:255'
        ]);

        //return validator failure status
        return $validator->errors()->toArray();
    }
}
