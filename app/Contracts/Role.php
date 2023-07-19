<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Role
{
    /**
     * Check if a Role has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermissionTo(string $permission): bool;

    /**
     * Get related permissions
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany;
}
