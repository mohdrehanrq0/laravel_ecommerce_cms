<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminAuth
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
        if($request->session()->has('admin_login') && $request->session()->has('user') && $request->session()->has('user_id')){
            return $next($request);
        }else{
            $request->session()->flash('msg','Access Denied');
            return redirect('admin');
        }
        
    }
}