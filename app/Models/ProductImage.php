<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
       
    ];


    public function product(){
        return $this->belongsTo(Product::class);  // assuming Product model has a foreign key 'product_id' in the 'products' table  // this is assuming you have a 'products' table and a 'product_images' table with a foreign key relationship. If not, adjust the model names and foreign key accordingly.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  // This line will create a relationship with the Product model.  //
    } 
}
