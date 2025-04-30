<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'amount',
        'status',
        'paypal_transaction_id',
        'payment_date',
        'payment_method',
        'attempts',
        'last_error'
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2'
    ];

    /**
     * The user that made the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The product associated with the payment.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The bid associated with the payment.
     */
    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }
}
