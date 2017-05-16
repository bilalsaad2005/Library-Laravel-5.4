<?php

namespace App\Http\Middleware;

use Closure;

class Create
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $SuperAdmin, $Admin)
    {
        $User = $request->user();

        return ($User->hasRole($SuperAdmin)||$User->hasRole($Admin))?$next($request):response(view('errors.401'), 401);
    }
}
