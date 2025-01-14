<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'user_id',
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
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function User()
    {
        return $this->belongsToMany(User::class, 'volunteer_user', 'volunteer_id', 'user_id')->withTimestamps();
    }
}
