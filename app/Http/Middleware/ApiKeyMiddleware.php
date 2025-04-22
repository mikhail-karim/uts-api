<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiKeyMiddleware
{
    // public function handle(Request $request, Closure $next): Response
    // {
    //     $apiKey = $request->header('X-API-KEY');

    //     if (!$apiKey || $request->user()->api_key !== $apiKey) {
    //         return response()->json(['message' => 'Invalid API Key'], 403);
    //     }

    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->bearerToken();

        if (!$apiKey || !User::where('api_key', $apiKey)->exists()) {
            return response()->json(['message' => 'Invalid API Key'], 401);
        }

        $user = User::where('api_key', $apiKey)->first();

        // if (!$user) {
        //     return response()->json(['message' => 'Invalid API Key'], 401);
        // }

        $request->setUserResolver(fn () => $user);

        // Auth::shouldUse('web');
        // Set the authenticated user
        // Auth::login($user);
        Auth::setUser($user);

        return $next($request);
    }

    
}

