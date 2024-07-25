<?php

namespace App\Models;

use App\Models\Scopes\AdminRoleScope;

class Admin extends User
{
    protected $table = 'users';

    protected $guard_name = 'api';

    protected static function booted()
    {
        static::addGlobalScope(new AdminRoleScope);
    }
}
