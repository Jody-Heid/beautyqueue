<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Spatie\Permission\Models\Role;

class CustomerRoleScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $customerRole = Role::findByName('customer');
        $builder->whereHas('roles', function (Builder $query) use ($customerRole) {
            $query->where('role_id', $customerRole->id);
        });
    }
}
