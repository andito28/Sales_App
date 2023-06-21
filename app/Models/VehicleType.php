<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_name_id',
        'type'
    ];

    public function DreamVehicle(){
        return $this->hasMany(DreamVehicle::class);
    }
}
