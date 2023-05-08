<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_brand_id',
        'vehicle_name_id',
        'vehicle_type_id',
    ];

    public function VehicleBrand(){
        return $this->belongsTo(VehicleBrand::class);
    }

    public function VehicleName(){
        return $this->belongsTo(VehicleName::class);
    }

    public function VehicleType(){
        return $this->belongsTo(VehicleType::class);
    }

}
