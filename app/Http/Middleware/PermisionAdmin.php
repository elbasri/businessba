<?php

namespace App\Http\Middleware;

use Closure;

class PermisionAdmin
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
        if(auth()->user()) {
            if(auth()->user()->type == 'admin') {
                return $next($request);
            } elseif (auth()->user()->hasPermissionTo('Admin')) {
                return $next($request);
            } else {
                return abort(404);
            }
        }
        return redirect(GetSettings()->admin_path.'/login');
    }
}
