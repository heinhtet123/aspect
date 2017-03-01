<?php

namespace App\Http\Middleware;
use Closure;


class AspectPermission
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
        // dd(\Aspect::user());

       if(!\Aspect::user()->hasRole()){
            abort(403,"You are not registered member so that you are not authorized");
       }
       
       

      if(!\Aspect::RoleHaspermission())
      {
        abort(403,"You are not authorized for this action");
      }
        


        return $next($request);
    }
}
