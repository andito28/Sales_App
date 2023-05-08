<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'date_of_birth',
        'gender',
        'regency',
        'subdistrict',
        'village',
        'address',
        'company',
        'notes'
    ];

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }

    public function CustomerInfo(){
        return $this->hasOne(CustomerInfo::class);
    }
}
