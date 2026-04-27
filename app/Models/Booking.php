<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id',
        'full_name',
        'phone',
        'email',
        'adult_count',
        'child_count',
        'departure_date',
        'message',
        'status'
    ];

    // Quan hệ: booking thuộc về tour
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}