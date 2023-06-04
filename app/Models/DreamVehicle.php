<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DreamVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'status',
        'item_condition',
        'vehicle_brand_id',
        'vehicle_name_id',
        'vehicle_type_id',
        'vehicle_color_id',
        'transmission',
        'payment',
        'purchase_date',
        'leasing',
        'dp',
        'repayment',
        'installment',
        'number_of_month',
        'ownership',
        'notes',
        'sold_status',
    ];

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }

    public function VehicleName(){
        return $this->belongsTo(VehicleName::class);
    }

    public function VehicleBrand(){
        return $this->belongsTo(VehicleBrand::class);
    }

    public function VehicleType(){
        return $this->belongsTo(VehicleType::class);
    }

    public function VehicleColor(){
        return $this->belongsTo(VehicleColor::class);
    }
}
