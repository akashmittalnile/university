<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check())
        {
            if(Auth::user()->admin == 1){
                return $next($request);
            }else{
                Auth::logout();
                return redirect('/sign-in')->with('error', 'Unauthorized access');
            }
        }else{
            return redirect('/sign-in')->with('error', 'Unauthorized access');
        }
    }
}
