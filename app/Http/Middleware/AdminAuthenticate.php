<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthenticate
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
        //login check

        if (!session()->has('admin_login')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/login');
            }
        }

        //permission check.

       $action = last(explode('\\', request()->route()->getActionName()));
       if (!in_array($action, config('permissions.'.session('admin_login')->permission))) {
           flash('Not have permission!', 'error');
           return redirect('admin/notice');
       }

        return $next($request);
    }
}
