<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Spatie\Permission\Models\Role;

class AdminRoleScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $adminRole = Role::findByName('admin', 'api');
        $builder->whereHas('roles', function (Builder $query) use ($adminRole) {
            $query->where('role_id', $adminRole->id);
        });
    }
}
