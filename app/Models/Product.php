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
     * Relasi ke Category (One Product has many Categories)
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
