<?php

namespace Tests\Unit;

use DatabaseSeeder;
use Tests\TestCase;
use App\Http\Middleware\CheckRolePermissions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CheckRolePermissionsMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if middleware redirects user without correct permissions
     */
    public function test_middleware_with_permissions(): void
    {
        $this->seed(DatabaseSeeder::class);

        $superAdmin = User::where('name', 'Super Admin')->first();
        $this->actingAs($superAdmin);
        $this->assertAuthenticatedAs($superAdmin);

        $request = Request::create('/admin/roles/create', 'GET');
        $next = function ($request) {
            return response('Passed middleware');
        };

        $middleware = new CheckRolePermissions();
        $response = $middleware->handle($request, $next, 'edit_roles');

        $this->assertEquals('Passed middleware', $response->getContent());
    }

    /**
     * Test if middleware redirects user without correct permissions
     */
    public function test_middleware_without_permissions(): void
    {
        $this->seed(DatabaseSeeder::class);

        $admin = User::where('name', 'Admin')->first();
        $this->actingAs($admin);
        $this->assertAuthenticatedAs($admin);

        $request = Request::create('/admin/roles/create', 'GET');
        $next = function ($request) {
            return response('Passed middleware');
        };

        $middleware = new CheckRolePermissions();
        $response = $middleware->handle($request, $next, 'edit_roles');

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(url('/admin/dashboard'), $response->getTargetUrl());
    }
}
