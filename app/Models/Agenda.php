<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_id',
        'title',
        'status',
        'date',
        'time',
        'location'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
}
