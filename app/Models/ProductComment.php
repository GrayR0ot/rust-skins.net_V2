<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'product_id'];

    protected static function booted()
    {
        static::creating(function ($comment) {
            $comment->user_id = auth()->id();
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
