<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'noticket',
        'userid',
        'scheduleid',
        'statuspay',
        'seatid',
        'paymentid',
        'bukti_pembayaran',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'id', 'scheduleid');
    }

    public function  payment()
    {
        return $this->belongsTo(Payment::class, 'paymentid', 'id');
    }
}
