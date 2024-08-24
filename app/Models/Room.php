<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotelId',
        'categories',
        'room_type',
        'price',
        'facilities',
        'numberOfBed',
        'bedCategories'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'roomId', 'id');
    }

}
