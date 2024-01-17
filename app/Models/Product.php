<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [''];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    public function spesifications()
    {
        return $this->hasMany(ProductSpesification::class, 'product_id', 'id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }

    public function variationLowerPrice()
    {
        return $this->hasOne(ProductVariation::class, 'product_id', 'id')->orderBy('price');
    }

    public function variationHigherPrice()
    {
        return $this->hasOne(ProductVariation::class, 'product_id', 'id')->orderBy('price', 'desc');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
