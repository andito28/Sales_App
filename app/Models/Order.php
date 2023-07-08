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
        'evidence_of_transfer',
        'bank_name',
        'name',
        'uniq_number',
        'affiliate_code',
        'total_price',
        'status'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function SubscriptionPackage(){
        return $this->belongsTo(SubscriptionPackage::class);
    }
}
