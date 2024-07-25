<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'customer_id',
        'staff_id',
        'offered_service_id',
        'appointment_date',
        'appointment_time',
        'status',
    ];

    protected $casts = [
        'status' => AppointmentStatus::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function hairstylist(): BelongsTo
    {
        return $this->belongsTo(Hairstylist::class, 'staff_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(OfferedService::class, 'offered_service_id');
    }
}
