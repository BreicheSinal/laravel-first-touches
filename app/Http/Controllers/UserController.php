<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Article;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function get_news(){
        $news = News::all();

        return response()->json([
            "news" => $news
        ]);
    }

    function post_article(Request $request, $news_id){
        // validating request data
        $validated = $request->validate([
            'content' => 'required|string',
            'attachment' => 'nullable|file',
        ]);    
    }
}
