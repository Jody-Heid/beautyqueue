<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTenant
{
    /**
     * Define a relationship with the Tenant model.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Scope a query to filter records by the current tenant's ID.
     */
    public function scopeForTenant(Builder $query): Builder
    {
        if ($tenantId = session('currentTenant')) {
            return $query->where('currentTenant', $tenantId);
        }

        return $query;
    }
}
