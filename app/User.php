<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use willvincent\Rateable\Rateable;

class User extends Authenticatable 
{
    use Rateable, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'contact_point', 'encrypted_password',
    ];

    public function getAuthPassword()
    {
        return $this->encrypted_password;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'encrypted_password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userable()
    {
        return $this->morphTo();
    }

    public function findForPassport($username)
    {
        return $this->where('contact_point', $username)->first();
    }


    public function retrieveByCredentials(array $credentials)
    {
        dd($credentials);
    }
}
