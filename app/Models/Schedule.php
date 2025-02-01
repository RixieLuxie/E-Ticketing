<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'airlineid',
        'planesid',
        'departuredate',
        'arrivaldate',
        'departing',
        'arriving',
        'Status',
        'price',
    ];

    public function airline()
    {
        return $this->hasOne(Airline::class, 'id', 'airlineid');
    }

    public function plane()
    {
        return $this->hasOne(Plane::class, 'id', 'planesid');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'scheduleid', 'id');
    }
}
