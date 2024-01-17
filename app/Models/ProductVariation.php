<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getPhotos()
    {
        return '/storage/' . $this->photos;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
