<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\CastMovie;
use App\Models\Genre;
use App\Models\Movie;

class MovieTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_movie_has_fillable_attributes()
    {
        $movie = new Movie();

        $this->assertEquals([
            'title',
            'synopsis',
            'year',
            'available',
            'genre_id',
        ], $movie->getFillable());
    }

    public function test_movie_belongs_to_genre()
    {
        $genre = Genre::factory()->create();
        $movie = Movie::factory()->create(['genre_id' => $genre->id]);

        $this->assertInstanceOf(Genre::class, $movie->genre);
        $this->assertEquals($genre->id, $movie->genre->id);
    }

    public function test_movie_has_many_cast_movies()
    {
        $movie = Movie::factory()->create();
        $castMovies = CastMovie::factory()->count(3)->create(['movie_id' => $movie->id]);

        $this->assertCount(3, $movie->castMovies);
        $this->assertInstanceOf(CastMovie::class, $movie->castMovies->first());
    }

    public function test_movie_can_set_and_get_attributes()
    {
        $movie = Movie::factory()->create([
            'title' => 'Inception',
            'synopsis' => 'A mind-bending thriller.',
            'year' => '2010',
            'available' => true,
        ]);

        $this->assertEquals('Inception', $movie->title);
        $this->assertEquals('A mind-bending thriller.', $movie->synopsis);
        $this->assertEquals('2010', $movie->year);
        $this->assertTrue($movie->available);
    }
}
