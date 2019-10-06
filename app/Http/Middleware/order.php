<?php

namespace App\Http\Middleware;

use Closure;

class order
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
         if(Auth::check() && Auth::user() ->isRole() == "company")
        {
            //id this user really company
            return $next($request);

        }
        return redirect('login');
    }
}
