<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Model\User\User;
use Illuminate\Contracts\Auth\Guard;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {


        if(auth()->user()->userType->user_type == 'Admin'){
            return $next($request);
        }
        return redirect('/login')->back()->with('error','You have not admin access');
    }
}
