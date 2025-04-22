<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller // implements HasMiddleware
{
    use AuthorizesRequests;

    // public static function middleware()
    // {
    //     return [
    //         new Middleware('api_key', except: ['index', 'show', 'destroy'])
    //     ];
    // }
    public function index(Request $request)
    {
        return Movie::where('user_id', $request->user()->id)->get();
    }

    public function listView()
    {
        /** @var User $user */
        $user = Auth::user();
        $movies = $user->movies()->latest()->get();
        return view('movies.index', compact('movies'));
    }
    


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'note' => 'nullable|string',
            'imdb_id' => 'nullable|string',
        ]);
    
        $data['user_id'] = $request->user()->id;
    
        // Fetch OMDB data
        $omdb = $this->fetchOmdbData($data['title']);
    
        if ($omdb) {
            $data['poster_url'] = $omdb['poster'];
        }
    
        Movie::create($data);
    
        return redirect()->route('movies.index');
    }

    private function fetchOmdbData($title)
    {
        $apiKey = env('OMDB_API_KEY'); // Make sure this exists in .env
        $response = Http::get("http://www.omdbapi.com/", [
            't' => $title,
            'apikey' => $apiKey,
        ]);
    
        if ($response->successful() && $response->json('Response') === 'True') {
            return [
                'poster' => $response->json('Poster'),
                'year' => $response->json('Year'),
                'genre' => $response->json('Genre'),
            ];
        }

        return null;
    }

    public function show($id)
    {
        // // return Movie::findOrFail($id);
        // $movie = Movie::findOrFail($id);

        // $this->authorize('view', $movie); // Optional: enforce ownership policy
    
        // $omdbData = $this->fetchOmdbData($movie->title); // get OMDB details
    
        // return view('movies.show', [
        //     'movie' => $movie,
        //     'omdb' => $omdbData,
        // ]);
        $movie = Movie::findOrFail($id);

        $poster = null;
        $year = null;
        $genre = null;
    
        if ($movie->imdb_id) {  
            $omdbApiKey = env('OMDB_API_KEY');
            $response = Http::get("http://www.omdbapi.com/?i={$movie->imdb_id}&apikey={$omdbApiKey}");
    
            if ($response->ok() && $response->json()['Response'] === 'True') {
                $data = $response->json();
                $poster = $data['Poster'] ?? null;
                $year = $data['Year'] ?? null;
                $genre = $data['Genre'] ?? null;
            } else {
                logger()->warning('OMDB fetch failed', [
                    'imdb_id' => $movie->imdb_id,
                    'response' => $response->json()
                ]);
            }
        }
    
        return view('movies.show', compact('movie', 'poster', 'year', 'genre'));
        //return response()->json($movie);
    }

    public function edit(Movie $movie)
    {
        // Make sure the user owns this movie
        $this->authorize('modify', $movie);

        return view('movies.edit', compact('movie'));
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
            // 'title' => 'required|string|max:255',
            'status' => 'required|string',
            'note' => 'nullable|string',
            // 'imdb_id' => 'nullable|string',
            // 'poster_url' => 'nullable|url',
        ]);
    
        $movie->update($data);
        
        if ($request->wantsJson()) {
            return response()->json(['movie' => $movie, 'user' => $movie->user]);
        }
    
        return redirect()->route('movies.show', $movie->id)->with('success', 'Movie updated successfully!');
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
    
        // return response()->json(['message' => 'Movie deleted']);
        return redirect()->route('movies.index')->with('success', 'Movie deleted');
    }
}
