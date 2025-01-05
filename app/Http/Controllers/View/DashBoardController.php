<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;

class DashBoardController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        $genres = Genre::all();

        return view('dashboard', compact('movies', 'genres')); 
    }

    public function insert(Request $request)
    {
        $movie = new Movie();
        $movie->title = $request->title;
        $movie->synopsis = $request->synopsis;
        $movie->poster = $request->poster;
        $movie->year = $request->year;
        $movie->available = $request->available;
        $movie->genre_id = $request->genre;
        $movie->save();

        return redirect()->route('dashboard.index');
    }
}
