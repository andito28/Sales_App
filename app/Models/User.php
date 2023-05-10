<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Reminder(){
        return $this->hasMany(Reminder::class);
    }

    public function Agenda(){
        return $this->hasMany(Reminder::class);
    }

    public function ToDo(){
        return $this->hasMany(ToDo::class);
    }

    public function Order(){
        return $this->hasMany(Order::class);
    }

    public function Subscriber(){
        return $this->hasOne(Subscriber::class);
    }

    public function Notification(){
        return $this->hasMany(Notification::class);
    }

    public function Affiliate(){
        return $this->hasOne(Affiliate::class);
    }

    public function UserFee(){
        return $this->hasMany(UserFee::class);
    }

}
