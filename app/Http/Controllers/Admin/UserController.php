<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\UserUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Display all users
     */
    public function view(Request $request): Response
    {
        $users = User::all()->except(Auth::id());
        return Inertia::render('Admin/Users/List', [
            'users' => $users,
            'status' => session('status'),
        ]);
    }

    /**
     * Display from for adding a user 
     */
    public function create(Request $request): Response
    {
        $roles = Role::all();
        return Inertia::render('Admin/Users/Create', [
            'roles' => $roles,
            'status' => session('status'),
        ]);
    }

    /**
     * Display from for editing a role and deleting the user
     */
    public function edit(Request $request, string $id): Response
    {
        $user = User::find($id); 
        $roles = Role::all();
        $user->roles->toArray();
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'roles' => $roles,
            'status' => session('status'),
        ]);
    }

    /**
     * Update a user
     */
    public function update(UserUpdateRequest $request) : RedirectResponse
    {
        $formData = $request->all();
        $user = User::find($formData['id']); 
        $user->roles()->sync($formData['roles']);
        $user->fill($request->validated());
        $user->save();

        return Redirect::route('users.edit', ['id' => $user->id]);
    }

}