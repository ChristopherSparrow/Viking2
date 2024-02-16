<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles as HasRolesTrait;

class HasRoles extends Model
{
    use HasRolesTrait;
}