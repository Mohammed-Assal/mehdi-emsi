<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorization');

        if (!$header || !str_starts_with($header, 'Bearer ')) {
            return response()->json([
                'message' => 'Unauthorized: Missing token'
            ], 401);
        }

        $token = substr($header, 7); // remove 'Bearer '

        // Verify Sanctum token
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json([
                'message' => 'Unauthorized: Invalid token'
            ], 401);
        }

        // Set authenticated user for request
        $request->merge(['user' => $accessToken->tokenable]);

        return $next($request);
    }
}
