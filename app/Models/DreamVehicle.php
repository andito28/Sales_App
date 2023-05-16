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
        'leasing',
        'dp',
        'repayment',
        'installment',
        'number_of_month',
        'ownership',
        'notes',
        'sold_status'
    ];

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
}
