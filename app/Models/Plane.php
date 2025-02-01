<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    protected $fillable = ['name', 'airlineid'];

    public function airline()
    {
        return $this->hasOne(Airline::class, 'id', 'airlineid');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class, 'planeid', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
