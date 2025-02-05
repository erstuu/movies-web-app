<?php

namespace App\Http\Controllers\View;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('home', compact('movies')); 
    }
}