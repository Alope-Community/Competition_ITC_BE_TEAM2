<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
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
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function User()
    {
        return $this->belongsToMany(User::class, 'donation_user', 'donation_id', 'user_id')->withTimestamps();
    }
}
