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
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [];

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

    public function pets()
    {
        return $this->hasMany(Pet::class, 'owner_id');
    }

    public function vet()
    {
        return $this->hasOne(Vet::class, 'vet_id');
    }
    public function shelter()
    {
        return $this->hasOne(Shelter::class, 'shelter_id');
    }

    public function appointmentsAsVet()
    {
        return $this->hasMany(Appointment::class, 'vet_id');
    }

    public function appointmentsAsOwner()
    {
        return $this->hasMany(Appointment::class, 'owner_id');
    }

    public function adoption()
    {
        return $this->hasMany(Adoption::class, 'shelter_id');
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'owner_id');
    }

}
