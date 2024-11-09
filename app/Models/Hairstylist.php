<?php

namespace App\Models;

use App\Models\Scopes\HairstylistRoleScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hairstylist extends User
{
    protected $guard_name = 'api';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope(new HairstylistRoleScope);
    }

    public function staffAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'staff_id');
    }
}
