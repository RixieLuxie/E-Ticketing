<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'logo',
        'name',
        'nomortujuan'
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class, 'paymentid', 'id');
    }
}
