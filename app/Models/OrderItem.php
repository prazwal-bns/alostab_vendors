<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
