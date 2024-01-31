<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDistricts extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');
    }
}
