<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function get_news(){
        $news = News::all();

        return response()->json([
            "news" => $news
        ]);
    }
}
