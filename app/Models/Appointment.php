<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Appointment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'service_id',
        'appointment_time',
        'appointment_date',
        'status',
        'total_price',
        'duration_minutes',
        'notes',
        'rating',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'total_price' => 'decimal:2',
        'duration_minutes' => 'integer',
        'rating' => 'integer',
        'status' => AppointmentStatus::class,
    ];

    /**
     * Get the full appointment datetime.
     *
     * @return Carbon
     */
    public function getAppointmentDatetimeAttribute()
    {
        return Carbon::parse($this->appointment_date->format('Y-m-d').' '.$this->appointment_time);
    }

    /**
     * Set the appointment date.
     *
     * @param  string  $value
     * @return void
     */
    public function setAppointmentDateAttribute($value)
    {
        $this->attributes['appointment_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Set the appointment time.
     *
     * @param  string  $value
     * @return void
     */
    public function setAppointmentTimeAttribute($value)
    {
        $this->attributes['appointment_time'] = Carbon::parse($value)->format('H:i:s');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(OfferedService::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isNoShow(): bool
    {
        return $this->status === 'no-show';
    }

    public function canBeRated(): bool
    {
        return $this->isCompleted() && is_null($this->rating);
    }

    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;

        if ($hours > 0) {
            return $hours.'h '.($minutes > 0 ? $minutes.'m' : '');
        }

        return $minutes.'m';
    }
}
