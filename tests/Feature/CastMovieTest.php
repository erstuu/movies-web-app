<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cast;
use App\Models\CastMovie;
use App\Models\Movie;

class CastMovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_cast_movie_has_fillable_attributes()
    {
        $castMovie = new CastMovie();

        $this->assertEquals(['movie_id', 'cast_id'], $castMovie->getFillable());
    }

    public function test_cast_movie_belongs_to_movie()
    {
        $movie = Movie::factory()->create();
        $castMovie = CastMovie::factory()->create(['movie_id' => $movie->id]);

        $this->assertInstanceOf(Movie::class, $castMovie->movie);
        $this->assertEquals($movie->id, $castMovie->movie->id);
    }

    public function test_cast_movie_belongs_to_cast()
    {
        $cast = Cast::factory()->create();
        $castMovie = CastMovie::factory()->create(['cast_id' => $cast->id]);

        $this->assertInstanceOf(Cast::class, $castMovie->cast);
        $this->assertEquals($cast->id, $castMovie->cast->id);
    }
}
