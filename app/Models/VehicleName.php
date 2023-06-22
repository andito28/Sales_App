<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleName extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_brand_id',
        'name'
    ];

    public function DreamVehicle(){
        return $this->hasMany(DreamVehicle::class);
    }

    public function vehicleBrand(){
        return $this->belongsTo(VehicleBrand::class);
    }
}
