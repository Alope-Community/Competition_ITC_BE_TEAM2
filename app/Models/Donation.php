<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'donation_url',
        'web_url',
        'registration_url',
        'start_date',
        'end_date',
        'image_url',
        'status',
    ];
}
