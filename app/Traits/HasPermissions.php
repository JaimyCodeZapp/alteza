<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Permission;

trait HasPermissions
{
    /**
     * The permissions that belong to the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    /**
     * Check if the role has a certain permission
     */
    public function hasPermissionTo(String $permission): Bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }
}