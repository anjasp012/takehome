<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'inscurance_price', 'shipping_price', 'total_price', 'transaction_status', 'code'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
