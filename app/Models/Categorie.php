<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];
    /**
     * Get all the products associated with the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }

    public function Articles()
    {
        return $this->hasMany(Article::class,'category_id');
    }
}
