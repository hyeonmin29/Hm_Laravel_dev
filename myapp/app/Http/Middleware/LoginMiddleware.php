<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    # 세션 값 없으면 test페이지로 돌아감
    public function handle ($request, closure $next)
    {

        if (session('user_id') === null){
            return redirect('test');
        }

        return $next($request);
    }
}