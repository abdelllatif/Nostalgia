<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'amount',
        'status',
    ];

    /**
     * The product that the bid is associated with.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The user that made the bid.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
