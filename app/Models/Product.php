<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name_product',
        'thumbnail_url',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'quantity',
        'view',
        'input_day',
        'category_id',
        'is_type',
        'is_hot',
        'is_hot_deal',
        'is_new',
        'is_show_home',
    ];

    protected $casts = [
        'is_type' => 'boolean',
        'is_hot' => 'boolean',
        'is_hot_deal' => 'boolean',
        'is_new' => 'boolean',
        'is_show_home' => 'boolean',

    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function ProductImage (){
        return $this->hasMany(ProductImage::class); 
    }

    public function comments()
{
    return $this->hasMany(Comment::class);
}

}
