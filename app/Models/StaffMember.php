<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StaffMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'salon_id',
        'user_id',
        'name',
        'title',
        'email',
        'phone',
        'bio',
        'avatar_url',
        'commission_rate',
        'rating',
        'working_days',
        'is_active',
    ];

    protected $casts = [
        'commission_rate' => 'decimal:2',
        'rating' => 'decimal:2',
        'working_days' => 'array',
        'is_active' => 'boolean',
    ];

    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
