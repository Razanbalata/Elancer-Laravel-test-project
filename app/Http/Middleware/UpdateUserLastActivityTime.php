<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserLastActivityTime
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // dd(Auth::check(), $request->user());
        if (Auth::check()) {
            $user = $request->user()->forceFill([
                'last_activity_at' => now()
            ])->save();
        }

        return $next($request);
    }
}
