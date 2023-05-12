<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data_origin_id',
        'nama',
        'photo'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function DataOrigin(){
        return $this->belongsTo(DataOrigin::class);
    }

    public function Phone(){
        return $this->hasMany(Phone::class);
    }

    public function Email(){
        return $this->hasMany(Phone::class);
    }

    public function DreamVehicle(){
        return $this->hasMany(DreamVehicle::class);
    }

    public function Agenda(){
        return $this->hasMany(Agenda::class);
    }

    public function Reminder(){
        return $this->hasMany(Reminder::class);
    }

    public function SubmissionPhoto(){
        return $this->hasMany(SubmissionPhoto::class);
    }

}
