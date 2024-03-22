<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_number',
        'type',
        'capacity',
        'price_per_night',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($room) {
            $room->is_available = true;
        });
    }
}
