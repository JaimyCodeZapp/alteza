<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Permission as PermissionContract;
use App\Traits\HasRoles;

class Permission extends Model implements PermissionContract
{
    use HasRoles;

    protected $fillable = ['name'];
}