<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $fillable = [
        "username", 
        "email", 
        "password",
        "role"
    ];

    public function isUser(): bool{
        return $this->role === 'user';
    }

    public function isAdmin(): bool{
        return $this->role === 'admin';
    }

}
