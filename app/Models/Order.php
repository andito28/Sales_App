<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_package_id',
        'total_price',
        'status'
    ];

    public function SubscriptionPackage(){
        return $this->belongsTo(SubscriptionPackage::class);
    }
}
