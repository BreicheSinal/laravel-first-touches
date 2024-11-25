<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    
    protected $fillable = [
        "username", 
        "email", 
        "role"
    ];

    protected $hidden = [
        'password'
    ];
}
