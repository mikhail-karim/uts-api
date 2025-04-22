<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OmdbController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $apiKey = env('OMDB_API_KEY'); // store your OMDb API key in .env
        $title = $request->query('title');

        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => env('OMDB_API_KEY'),
            't' => $title
        ]);

        if ($response->successful() && $response['Response'] === 'True') {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Movie not found or OMDb error.'], 404);
        }
    }
}

