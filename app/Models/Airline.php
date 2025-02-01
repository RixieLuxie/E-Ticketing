<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $fillable = [
        'name',
        'code',
        'country',
        'status',
    ];

    public function planes()
    {
        return $this->hasMany(Plane::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
