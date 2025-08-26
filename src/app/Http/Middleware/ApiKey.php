<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $provided = $request->header('X-API-KEY');
        $expected = env('APP_API_KEY'); // simple for interview; could use config()

        if (!$provided || $provided !== $expected) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
