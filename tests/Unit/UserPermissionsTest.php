<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DatabaseSeeder;

class UserPermissionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if seeded users have permissions
     */
    public function test_user_has_permissions(): void
    {
        $this->seed(DatabaseSeeder::class);

        $superAdmin = User::where('name', 'Super Admin')->first();
        $this->assertTrue($superAdmin->hasPermissionTo('edit_roles'));

        $admin = User::where('name', 'Admin')->first();
        $this->assertFalse($admin->hasPermissionTo('edit_roles'));
        $this->assertTrue($admin->hasPermissionTo('read_roles'));
    }
}
