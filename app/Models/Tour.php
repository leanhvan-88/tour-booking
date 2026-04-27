<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'departure',
        'destination',
        'price',
        'image',        // link ảnh (URL)
        'description',
        'itinerary'
    ];



    /**
     * Nếu không có ảnh thì fallback
     */
    public function getImageAttribute($value)
    {
        return $value ?: 'https://via.placeholder.com/300x200?text=No+Image';
    }

    /**
     * Quan hệ booking
     */
    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
}