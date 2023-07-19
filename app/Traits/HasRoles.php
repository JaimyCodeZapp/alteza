<?php
namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    /**
     * The roles that belong to the user.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();
    }

    /**
     * Check if the role has a certain permission
     */
    public function hasPermissionTo(String $permission): Bool
    {
        foreach($this->roles as $role){
            if($role->hasPermissionTo($permission)){
                return true;
            }
        }
        return false;
    }
}