<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'codeseat',
        'planeid'
    ];

    public function plane()
    {
        return $this->hasOne(Plane::class, 'id', 'planeid');
    }
}
