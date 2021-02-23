<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'picture_path', 'price'];

    public function orders() {
        return $this->hasMany(Order::class)->where('status', '>', 1);
    }
    public function pending_orders() {
        return $this->hasMany(Order::class)->where('status', '=', 1);
    }
    public function likes() {
        return $this->hasMany(ProductLike::class);
    }
    public function comments() {
        return $this->hasMany(ProductComment::class);
    }
}
