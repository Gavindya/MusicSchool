<?php

namespace App\Http\Middleware;

use Auth;
use Closure;


class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userType = Auth::user()->role;

            if ($userType == "teacher") {
                return $next($request);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('login');
        }
    }
}
