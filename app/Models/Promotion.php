<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    // Các trường có thể điền
    protected $fillable = [
        'code', 
        'description', 
        'start_date', 
        'end_date', 
        'discount_amount', 
        'is_active'
    ];

    // Thiết lập quan hệ với User thông qua bảng user_promotions
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_promotions');
    }

    // Thiết lập quan hệ với Bill
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
