<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_fillable_attributes()
    {
        $user = new User();

        $this->assertEquals(
            ['name', 'email', 'password', 'role_id'],
            $user->getFillable()
        );
    }

    public function test_user_has_hidden_attributes()
    {
        $user = new User();

        $this->assertEquals(
            ['password', 'remember_token'],
            $user->getHidden()
        );
    }

    public function test_user_has_cast_attributes()
    {
        $user = new User();

        $this->assertEquals(
            ['email_verified_at' => 'datetime'],
            $user->getCasts()
        );
    }

    public function test_user_belongs_to_role()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertInstanceOf(Role::class, $user->role);
        $this->assertEquals($role->id, $user->role->id);
    }

    public function test_user_has_one_profile()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Profile::class, $user->profile);
        $this->assertEquals($profile->id, $user->profile->id);
    }
}
