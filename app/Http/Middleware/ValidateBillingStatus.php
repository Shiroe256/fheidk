<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateBillingStatus
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
        $reference_no = $request->reference_no;
        $billing_status = DB::table('tbl_fhe_billing_records')->where('reference_no', '=', $reference_no)->first()->billing_status;

        switch ($billing_status) {
            case 2:
            case 5:
            case 7:
            case 8:
            case 9:
            case 10:
                return response('error', 400);
                break;

            default:
                return $next($request);
                break;
        }
    }
}
