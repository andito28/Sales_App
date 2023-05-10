<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'photo'
    ];

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
}
