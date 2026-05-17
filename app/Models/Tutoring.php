<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutoring extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'topics',
        'availability',
        'price',
        'scheduled_date',
        'scheduled_time',
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
