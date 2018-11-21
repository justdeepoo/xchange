<?php

namespace App\Http\Middleware;
use Session;

use Closure;

class UserGroupMiddleware
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
        if(!Session::has('loggedin')){
            return redirect('/')->send();  
        }
        
        return $next($request);
    }
}
