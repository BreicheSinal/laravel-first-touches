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
            "message" => "success",
            "news" => $news
        ]);
    }

    function post_article(Request $request, $user_id, $news_id){
        // validating request data
        $validated = $request->validate([
            'content' => 'required|string',
            'attachment' => 'nullable|file',
        ]);

        // saving file in public storage
        $attachment = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment')->store('attachments', 'public');
        }

        // creating a new article
        $article = Article::create([
            'content' => $validated['content'],
            'attachment' => $attachment,
            'news_id' => $news_id,
            'user_id' => $user_id, 
        ]);

        return response()->json([
            "message" => "success",
            "article" => $article
        ]);
    }
}
