<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('login');
                //return response()->json(['status' => 'error']);
            }
        }

        return $next($request);

//        if (!$request->hasHeader('Authorization') && !$request->header('Authorization') !== '') {
//            return response()->json(['error' => true, 'message'=>'login first']);
//        }
//
//        $token = $request->header('Authorization');
//        $user = User::where('token_auth', $token)->firstOrFail();
//
//        if(!$user){
//            return response()->json(['error' => true, 'message'=>'login first']);
//        }
//
//        if(!Auth::check() || auth()->user() == $user){
//            Auth::login($user);
//        }
//
//        return $next($request);

    }
}
