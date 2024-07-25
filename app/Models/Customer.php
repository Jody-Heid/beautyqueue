<?php

namespace App\Models;

use App\Models\Scopes\CustomerRoleScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends User
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $guard_name = 'api';

    protected static function booted()
    {
        static::addGlobalScope(new CustomerRoleScope);
    }

    public function customerAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'customer_id');
    }
}
