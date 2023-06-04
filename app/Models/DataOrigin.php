<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrigin extends Model
{
    use HasFactory;

    protected $fillable = [
        'information'
    ];

    public function Contact(){
        return $this->hasMany(Contact::class);
    }
}
