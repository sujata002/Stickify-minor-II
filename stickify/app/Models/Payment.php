<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // for payment
    protected $fillable = [
        'user_id',
        'stripe_session_id',
        'amount',
        'currency',
        'status',
        'payment_method',
    ];

    // adding relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
