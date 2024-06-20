<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotelId',
        'numberOfRoom',
        'room_type',
        'price',
        'facilities',
        'numberOfBed',
        'bed_type'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'roomId', 'id');
    }

}
