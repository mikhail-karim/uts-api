<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey || $request->user()->api_key !== $apiKey) {
            return response()->json(['message' => 'Invalid API Key'], 403);
        }

        return $next($request);
    }
}

