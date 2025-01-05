<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Genre;
use App\Models\Movie;

class GenreTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_genre_has_fillable_attributes()
    {
        $genre = new Genre();

        $this->assertEquals(['name'], $genre->getFillable());
    }

    public function test_genre_has_many_movies()
    {
        $genre = Genre::factory()->create();
        $movies = Movie::factory()->count(3)->create(['genre_id' => $genre->id]);

        $this->assertCount(3, $genre->movies);
        $this->assertInstanceOf(Movie::class, $genre->movies->first());
    }
}
