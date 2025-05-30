<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand'
    ];

    public function DreamVehicle(){
        return $this->hasMany(DreamVehicle::class);
    }
}
