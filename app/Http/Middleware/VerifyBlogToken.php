<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyBlogToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token || !hash_equals(
            config('services.blog.token'),
            $token
        )) {
            return response()->json([
                'success' => false,
                'message' => 'Token inválido ou não informado.'
            ], 401);
        }

        return $next($request);
    }
}
