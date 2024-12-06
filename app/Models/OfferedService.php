<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfferedService extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'category_id',
        'name',
        'description',
        'price',
        'duration_minutes',
        'is_active',
        'requires_consultation',
        'requires_patch_test',
        'minimum_age',
        'required_products'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_minutes' => 'integer',
        'is_active' => 'boolean',
        'minimum_age' => 'integer',
        'required_products' => 'array'
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function getDurationInHours(): float
    {
        return $this->duration_minutes / 60;
    }

    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        if ($hours > 0) {
            return $hours . 'h ' . ($minutes > 0 ? "{$minutes} m" : '');
        }
        
        return "{$minutes} m";
    }

    public function getFormattedPrice(): string
    {
        return 'R' . number_format($this->price, 2);
    }
}
