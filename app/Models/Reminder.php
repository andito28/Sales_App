<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_id',
        'title',
        'reminder_date',
        'time',
        'notes',
        'frequency'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }

}
