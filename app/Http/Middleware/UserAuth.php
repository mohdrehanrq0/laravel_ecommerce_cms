<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('FRONT_LOGGEDIN') && $request->session()->has('FRONT_USERNAME') && $request->session()->has('FRONT_USERID')){
            return $next($request);
        }else{
            $request->session()->flash('msg','Access Denied');
            return redirect('/');
        }
    }
}
