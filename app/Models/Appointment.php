<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'salon_id',
        'client_id',
        'staff_member_id',
        'service_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'price',
        'discount',
        'final_price',
        'payment_status',
        'notes',
        'booking_source',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'confirmed' => ['bg' => 'bg-emerald-500/10 text-emerald-600 border-emerald-500/20', 'label' => 'Confirmed'],
            'in_progress' => ['bg' => 'bg-amber-500/10 text-amber-600 border-amber-500/20', 'label' => 'In Progress'],
            'completed' => ['bg' => 'bg-rose-500/10 text-rose-600 border-rose-500/20', 'label' => 'Completed'],
            'cancelled' => ['bg' => 'bg-red-500/10 text-red-600 border-red-500/20', 'label' => 'Cancelled'],
            'no_show' => ['bg' => 'bg-zinc-500/10 text-zinc-600 border-zinc-500/20', 'label' => 'No Show'],
            default => ['bg' => 'bg-blue-500/10 text-blue-600 border-blue-500/20', 'label' => ucfirst($this->status)],
        };
    }
}
