<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_code',
        'order_number',
        'products',
    ];

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'code', 'status_code');
    }
}
