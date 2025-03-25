<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'paypal_transaction_id',
        'payment_date'
    ];

    /**
     * The user that made the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The bids associated with the payment.
     */
    public function bid()
    {
        return $this->hasMany(Bid::class);
    }
}
