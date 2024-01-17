<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function getPhoto()
    {
        return '/storage/' . $this->photo;
    }
    public function subHeaderCategory()
    {
        return $this->belongsTo(SubHeaderCategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productsByCategory()
    {
        return $this->hasMany(Product::class)->limit(4);
    }
}
