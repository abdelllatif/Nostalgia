<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'historical_context',
        'starting_price',
        'auction_end_date',
        'category_id',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'auction_end_date' => 'datetime',
        'starting_price' => 'decimal:2',
    ];

    /**
     * The category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * The user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The images associated with the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * The tags associated with the product.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * The bids associated with the product.
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
