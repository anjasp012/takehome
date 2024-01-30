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
        if ($this->photos != '') {
            return '/storage/' . $this->photos;
        } else {
            return null;
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
