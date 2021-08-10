<?php

namespace App\Http\Middleware;

use Closure;

class DetectLocale
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
        if($locale = $request->header('locale')){

            app()->setlocale($locale);
            
        }
        return $next($request);
    }
}
