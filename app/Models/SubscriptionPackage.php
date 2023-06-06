<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'normal_price',
        'prices_apply',
        'number_of_month',
        'information'
    ];

    public function Order(){
        return $this->hasMany(Order::class);
    }

}
