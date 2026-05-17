<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'student_id',
        'tutoring_id',
        'booking_date',
        'booking_time',
        'total_price',
        'status',
        'payment_status',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutoring(): BelongsTo
    {
        return $this->belongsTo(Tutoring::class);
    }


}
