<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        $user = auth('api')->user();
        $roles = $user->roles;

        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                if ($role->hasPermissionTo($permission)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Unauthorized');
    }
}
