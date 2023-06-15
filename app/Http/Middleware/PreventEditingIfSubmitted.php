<?php

namespace App\Http\Middleware;

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
        if ($reference_no == 4) {
            return response('Not Success', 500);
        }
        return $next($request);
    }
}
