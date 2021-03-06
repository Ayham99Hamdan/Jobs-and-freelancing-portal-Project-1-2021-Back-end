<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class language
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
        App::setlocale($request->lang);
        return $next($request);
    }
}
