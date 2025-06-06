<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'affiliate_code'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
