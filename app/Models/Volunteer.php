<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'category', 
        'contact_phone', 
        'contact_instagram', 
        'registration_url', 
        'start_date',
        'end_date',
        'image_url', 
        'status',
    ];
}
