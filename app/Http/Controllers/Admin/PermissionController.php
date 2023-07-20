<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Http\Requests\Permission\PermissionCreateRequest;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display all permission
     */
    public function view(Request $request): Response
    {
        $permissions = Permission::all(); 
        return Inertia::render('Admin/Permissions/List', [
            'permissions' => $permissions,
            'status' => session('status'),
        ]);
    }

    /**
     * Display from for adding a permission 
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Admin/Permissions/Create', [
            'status' => session('status'),
        ]);
    }

    /**
     * Insert new permission
     */
    public function insert(PermissionCreateRequest $request): RedirectResponse
    {
        $permission = Permission::create($request->validated());
        return Redirect::route('permissions.edit', ['id' => $permission->id]);
    }
    
    /**
     * Display from for editing a permission and deleting the permission
     */
    public function edit(Request $request, string $id): Response
    {
        $permission = Permission::find($id); 
        return Inertia::render('Admin/Permissions/Edit', [
            'permission' => $permission,
            'status' => session('status'),
        ]);
    }

    /**
     * Update a permission
     */
    public function update(PermissionUpdateRequest $request) : RedirectResponse
    {
        $formData = $request->all();
        $permission = Permission::find($formData['id']); 
        $permission->fill($request->validated());
        $permission->save();

        return Redirect::route('permissions.edit', ['id' => $permission->id]);
    }

    /**
     * Delete a permission
     */
    public function destroy(Request $request, string $id): RedirectResponse
    {
        $permission = Permission::find($id);
        $permission->delete();

        return Redirect::route('permissions');
    }
}
