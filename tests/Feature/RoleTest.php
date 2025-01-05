<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_has_fillable_attributes()
    {
        $role = new Role();

        $this->assertEquals(['name'], $role->getFillable());
    }

    public function test_role_has_many_users()
    {
        $role = Role::factory()->create();
        $users = User::factory()->count(3)->create(['role_id' => $role->id]);

        $this->assertCount(3, $role->users);
        $this->assertInstanceOf(User::class, $role->users->first());
    }
}
