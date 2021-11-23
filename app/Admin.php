<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = [
        'email', 'encrypted_password'
    ];

    public function getAuthPassword()
    {
        return $this->encrypted_password;
    }

    protected $hidden = [
        'remember_token', 'encrypted_password'
    ];
}
