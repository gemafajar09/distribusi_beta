<?php

namespace App\Http\Middleware;

use Closure;

class cekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->exists('id')) {
            // user value cannot be found in session
            return redirect('/');
        }else{
            return $next($request);
        }

    }
}
