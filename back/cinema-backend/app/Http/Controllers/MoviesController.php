<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Sessions;

class MoviesController extends Controller
{
    public function index()
    {
        // Get all movies (id, title, image) from the database
        $movies = Movies::all();

        return response()->json($movies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image' => 'nullable|unique:movies',
                'title' => 'required|unique:movies',
                'director' => 'required',
                'actors' => 'array',
                'sinopsis' => 'required',
                'premiere' => 'date',
                'gendre' => 'string',
                'duration' => 'required',
                'classification' => 'required'
            ]);

            $movie = new Movies();

            $movie->image = $validatedData['image'] ?? null;
            $movie->title = $validatedData['title'];
            $movie->director = $validatedData['director'];
            $movie->actors = json_encode($validatedData['actors']);
            $movie->sinopsis = $validatedData['sinopsis'];
            $movie->duration = $validatedData['duration'] . " minutos";
            $movie->premiere = $validatedData['premiere'];
            $movie->gendre = $validatedData['gendre'];
            $movie->classification = $validatedData['classification'];

            if ($movie->save()) {
                return response()->json(['message' => 'Movie created successfully', 'movie' => $movie], 200);
            } else {
                return response()->json(['message' => 'Failed to create the movie'], 500);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Request $request)
    {
        $movie = Movies::where('id_movie', $request->id)->first();

        if ($movie) {
            return response()->json($movie);
        } else {
            return response()->json(['message' => 'Movie not found'], 404);
        }
    }

    public function update(Request $request)
    {
        $movie = Movies::where('id_movie', $request->id)->first();

        if ($movie) {
            $movie->update($request->all());
            return response()->json(['message' => 'Movie updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Movie not found'], 404);
        }
    }

    public function destroy($id)
    {
        $movie = Movies::where('id_movie', $id)->first();

        if ($movie) {
            $movie->delete();
            return response()->json(['message' => 'Movie deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Movie not found'], 404);
        }
    }

    public function moviesWithoutSession()
    {
        $movie_sessions = Sessions::pluck('movie_id');
        $movies = Movies::whereNotIn('id_movie', $movie_sessions)->get(['id_movie', 'title']);

        return response()->json($movies);
    }
}
