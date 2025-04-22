<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class MovieController extends Controller // implements HasMiddleware
{
    use AuthorizesRequests;

    // public static function middleware()
    // {
    //     return [
    //         new Middleware('auth:sanctum', except: ['index', 'show'])
    //     ];
    // }
    public function index(Request $request)
    {
        return Movie::where('user_id', $request->user()->id)->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'note' => 'nullable|string',
            'imdb_id' => 'nullable|string',
            'poster_url' => 'nullable|url',
        ]);

        $data['user_id'] = $request->user()->id;

        return Movie::create($data);
    }

    public function show($id)
    {
        return Movie::findOrFail($id);
    }

    public function update(Request $request, Movie $movie)
    {
        // $movie = Movie::findOrFail($id);

        // if ($movie->user_id !== $request->user()->id) {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        // $movie->update($request->all());

        // return $movie;

        // return response()->json($request->user());

        Gate::authorize('modify', $movie); // ✅ Enforce ownership

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'note' => 'nullable|string',
            'imdb_id' => 'nullable|string',
            'poster_url' => 'nullable|url',
        ]);
    
        $movie->update($data);
    
        return ['movie' => $movie, 'user' => $movie->user];
    }

    // public function destroy(Request $request, $id)
    // {
    //     $movie = Movie::findOrFail($id);

    //     if ($movie->user_id !== $request->user()->id) {
    //         return response()->json(['error' => 'Unauthorized'], 403);
    //     }

    //     $movie->delete();

    //     return response()->json(['message' => 'Movie deleted']);
    // }

    public function destroy(Movie $movie)
    {
        Gate::authorize('modify', $movie);

        $movie->delete();
    
        return response()->json(['message' => 'Movie deleted']);
    }
}
