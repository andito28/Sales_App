<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function Vehicle(){
        return $this->hasOne(Vehicle::class);
    }
}
