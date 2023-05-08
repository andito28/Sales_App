<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'dream_vehicle_id',
        'payment',
        'leasing',
        'dp',
        'installment',
        'number_of_month',
        'submission_foto'
    ];
}
