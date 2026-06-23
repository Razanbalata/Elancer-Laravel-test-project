<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        // Web request
        if (!$request->expectsJson()) {
            return redirect()->route('account.inactive');
        }

        // API request
        return response()->json([
            'message' => 'Account inactive'
        ], 403);
        return $next($request);
    }
}
