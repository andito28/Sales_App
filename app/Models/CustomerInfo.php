<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'relationship_status',
        'nama',
        'date_of_birth',
        'company',
        'notes'
    ];

    public function Customer(){
        return $this->belongsTo(CustomerInfo::class);
    }
}
