<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'reservation_id',
        'amount',
        'status',
        'stripe_session_id',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'payment_id');
    }
}
