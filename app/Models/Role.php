<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Role as RoleContract;
use App\Traits\HasPermissions;

class Role extends Model implements RoleContract
{
    use HasPermissions;

    protected $fillable = ['name'];
}