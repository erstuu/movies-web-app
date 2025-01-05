<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Profile;
use App\Models\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_has_fillable_attributes()
    {
        $profile = new Profile();

        $this->assertEquals(
            ['biodata', 'age', 'address', 'user_id'],
            $profile->getFillable()
        );
    }

    public function test_profile_belongs_to_user()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $profile->user);
        $this->assertEquals($user->id, $profile->user->id);
    }
}
