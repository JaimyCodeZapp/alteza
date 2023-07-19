<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display all roles
     */
    public function view(Request $request): Response
    {
        $roles = Role::all(); 
        return Inertia::render('Admin/Roles/List', [
            'roles' => $roles,
            'status' => session('status'),
        ]);
    }

    /**
     * Display from for adding a role 
     */
    public function create(Request $request): Response
    {
        $permissions = Permission::all();
        return Inertia::render('Admin/Roles/Create', [
            'permissions' => $permissions,
            'status' => session('status'),
        ]);
    }

    /**
     * Insert new role
     */
    public function insert(RoleCreateRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        $role = Role::create($formData);
        $role->permissions()->attach($formData['permissions']);
        return Redirect::route('roles.edit', ['id' => $role->id]);
    }
    
    /**
     * Display from for editing a role and deleting the role
     */
    public function edit(Request $request, string $id): Response
    {
        $role = Role::find($id); 
        $role->permissions->toArray();
        $permissions = Permission::all();
        return Inertia::render('Admin/Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions,
            'status' => session('status'),
        ]);
    }

    /**
     * Update a role
     */
    public function update(RoleUpdateRequest $request) : RedirectResponse
    {
        $formData = $request->all();
        $role = Role::find($formData['id']); 
        $role->permissions()->sync($formData['permissions']);
        $role->fill($request->validated());
        $role->save();

        return Redirect::route('roles.edit', ['id' => $role->id]);
    }

    /**
     * Delete a role
     */
    public function destroy(Request $request, string $id): RedirectResponse
    {
        $role = Role::find($id);
        $role->permissions()->detach();
        $role->delete();

        return Redirect::route('roles');
    }
}
