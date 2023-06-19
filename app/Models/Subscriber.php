<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'validity_period'
    ];

    public function subscriptionPackage(){
        return $this->belongsTo(SubscriptionPackage::class,'subscription_package_id');
    }
}
