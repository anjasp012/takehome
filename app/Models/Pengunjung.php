<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $table = 'pengunjung';
    protected $guarded = ['id'];

    public function produk()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
