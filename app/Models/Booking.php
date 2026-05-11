<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id',
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}