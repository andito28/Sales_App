<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DreamVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'vehicle_brand',
        'vehicle_name',
        'vehicle_type',
        'transmission',
        'color',
        'picture'
    ];

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }

    public function Transaction(){
        return $this->hasOne(Transaction::class);
    }
}
