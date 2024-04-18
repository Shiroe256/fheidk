<?php

namespace App\Http\Middleware;

use App\Models\Billing;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserHei
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
        //check log in
        if (!Auth::check()) {
            abort(401);
        }
        //check if billing exists
        if ($request->reference_no) {
            $reference_no = $request->reference_no;
            $billing = Billing::where('reference_no', $reference_no)->first();
            if (!$billing) {
                abort(404);
            }
        }
        //check if currently logged in user handles this billing
        $hei_uii = Auth::user()->hei_uii;
        if ($hei_uii != $billing->hei_uii) {
            abort(401);
        }
        // $request->merge(['hei_uii' => $hei_uii]);
        return $next($request);
    }
}
