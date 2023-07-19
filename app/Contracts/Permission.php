<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Permission
{
    /**
     * Check if a Permission has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermissionTo(string $permission): bool;

    /**
     * Get related roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany;
}
