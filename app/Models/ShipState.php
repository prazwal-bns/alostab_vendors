<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');
    }

    public function District()
    {
        return $this->belongsTo(ShipDistricts::class, 'district_id', 'id');
    }
}
