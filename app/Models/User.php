<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function Volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function Donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function Donation(){
        return $this->belongsToMany(Donation::class, 'donation_user', 'user_id', 'donation_id')->withTimestamps();
    }
    public function Volunteer(){
        return $this->belongsToMany(Volunteer::class, 'volunteer_user', 'user_id', 'volunteer_id')->withTimestamps();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
