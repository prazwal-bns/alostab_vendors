<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function District()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id', 'id');
    }

    public function City()
    {
        return $this->belongsTo(ShipCity::class, 'city_id', 'id');
    }

    public function State()
    {
        return $this->belongsTo(ShipState::class, 'state_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

}
