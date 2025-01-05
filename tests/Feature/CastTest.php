<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cast;
use App\Models\CastMovie;

class CastTest extends TestCase
{
    use RefreshDatabase;

    public function test_cast_has_fillable_attributes()
    {
        $cast = new Cast();

        $this->assertEquals(
            ['name', 'age', 'biodata', 'avatar'],
            $cast->getFillable()
        );
    }

    public function test_cast_has_many_cast_movies()
    {
        $cast = Cast::factory()->create();
        $castMovies = CastMovie::factory()->count(3)->create(['cast_id' => $cast->id]);

        $this->assertCount(3, $cast->castMovies);
        $this->assertInstanceOf(CastMovie::class, $cast->castMovies->first());
    }
}
