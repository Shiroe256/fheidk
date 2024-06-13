<?php

namespace App\Http\Middleware;

use App\Models\Billing;
use Closure;
use Illuminate\Http\Request;

class PreventEditingIfSubmitted
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
        $billing_status = Billing::where('reference_no',$reference_no)->first()->billing_status;
        if ($billing_status != 1 || $billing_status != 3 || $billing_status >= 5) {
            return response('Not Success', 500);
        }
        return $next($request);
    }
}
