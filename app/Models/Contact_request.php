<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_request extends Model
{
    use HasFactory;

    public function Contact_request()
    {
        return $this->belongsTo(User::class);
    }
}
