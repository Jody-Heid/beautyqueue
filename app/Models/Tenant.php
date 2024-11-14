<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone_number', 'address',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
