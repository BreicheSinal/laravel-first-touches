<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model{
    protected $fillable = [
        "content", 
        "attachment", 
        "news_id", 
        "user_id", 
    ];
}
