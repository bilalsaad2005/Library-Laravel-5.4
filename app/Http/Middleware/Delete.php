<?php

namespace App\Http\Middleware;

use Closure;

class Delete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $SuperAdmin)
    {
         $User = $request->user();

        return ($User->hasRole($SuperAdmin))?$next($request):response(view('errors.401'), 401);
    }
}
