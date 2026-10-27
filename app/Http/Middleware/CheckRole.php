<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
//    public function handle(Request $request, Closure $next, $role): Response
//    {
//        if (! $request->user()->hasRole($role)) {
//            abort(401, 'This action is unauthorized.');
//        }
//        return $next($request);
//    }

    public function handle($request, Closure $next, ... $roles)
    {
        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if($request->user()->hasRole($role))
                return $next($request);
        }
        abort(401, 'This action is unauthorized.');
    }
}
