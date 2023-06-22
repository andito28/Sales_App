<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_name_id',
        'color'
    ];

    public function DreamVehicle(){
        return $this->hasMany(DreamVehicle::class);
    }

    public function vehicleName(){
        return $this->belongsTo(VehicleName::class);
    }
}
