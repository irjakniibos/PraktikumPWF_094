<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_id',
    ];

    /**
     * Relasi ke Product (Many Categories belongs to one Product)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
