<?php

namespace App\Http\Middleware;
use Closure;

class Status
{
    public function handle($request, Closure $next)
    {
        $admin = $this->isAdmin($request->route());
        $is_Admin = auth()->user()->is_admin;
        if ($admin)
        {
            if(!$is_Admin)
                return response()->json(['error' => true, 'message'=>'you not admin']);
        }

        return $next($request);
    }

    function isAdmin($route) {
        $action = $route->getAction();
        return isset($action['admin'])? $action['admin'] : false ;
    }
}