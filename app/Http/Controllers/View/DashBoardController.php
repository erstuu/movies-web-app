<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class DashBoardController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('created_at', 'desc')->get();
        $genres = Genre::all();

        return view('dashboard', compact('movies', 'genres')); 
    }

    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'year' => 'required|integer',
            'available' => 'required|boolean',
            'genre' => 'required|exists:genres,id',
        ]);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $posterPath = $path;
        } else {
            $posterPath = null;
        }

        $movie = new Movie();
        $movie->title = $request->title;
        $movie->synopsis = $request->synopsis;
        $movie->poster = $posterPath;
        $movie->year = $request->year;
        $movie->available = $request->available;
        $movie->genre_id = $request->genre;
        $movie->save();

        return redirect()->route('dashboard.index')->with('success', 'Movie added successfully!');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        return response()->json($movie);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'year' => 'required|integer',
            'available' => 'required|boolean',
            'genre' => 'required|exists:genres,id',
        ]);

        $movie = Movie::findOrFail($id);

        if ($request->hasFile('poster')) {
            if ($movie->poster && Storage::disk('public')->exists($movie->poster)) {
                Storage::disk('public')->delete($movie->poster);
            }

            $path = $request->file('poster')->store('posters', 'public');
            $movie->poster = $path;
        }

        $movie->title = $request->title;
        $movie->synopsis = $request->synopsis;
        $movie->year = $request->year;
        $movie->available = $request->available;
        $movie->genre_id = $request->genre;
        $movie->save();

        return redirect()->route('dashboard.index')->with('success', 'Movie updated successfully!');
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('dashboard.index')->with('success', 'Movie deleted successfully!');
    }
}