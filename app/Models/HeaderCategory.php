<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeaderCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'photo', 'slug'];

    protected $hidden = [''];

    public function getPhoto()
    {
        return '/storage/' . $this->photo;
    }
    public function subHeaderCategories()
    {
        return $this->hasMany(SubHeaderCategory::class);
    }
}
