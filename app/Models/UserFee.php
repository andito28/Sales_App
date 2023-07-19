<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fee',
        'paid',
        'status'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

}
