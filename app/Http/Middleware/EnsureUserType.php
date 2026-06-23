<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$type): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        if (!in_array($user->type, $type)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => "unaouthorized"
                ], 403);
            }
            return redirect()->route('account.inactive');
        }
        $response = $next($request);
        // $response->headers->set('x-custom','sss');
        return $response;
    }
}
