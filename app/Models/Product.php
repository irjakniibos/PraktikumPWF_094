<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'qty',
        'price',
        'category_id',
        'user_id',
    ];

    /**
     * Relasi ke User (Many Product belongs to one User)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Category (Many Products belongs to one Category)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
