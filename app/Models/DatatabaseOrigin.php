<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatatabaseOrigin extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'origin'
    ];

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
}
