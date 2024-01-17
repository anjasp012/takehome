<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubHeaderCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function getPhoto()
    {
        return '/storage/' . $this->photo;
    }
    public function headerCategory()
    {
        return $this->belongsTo(HeaderCategory::class);
    }
    public function Categories()
    {
        return $this->hasMany(Category::class);
    }
}
