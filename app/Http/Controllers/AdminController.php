<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function post_news(Request $request, $admin_id){

        //checking if user exists
        $user = User::find($admin_id);
        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ],404);
        }

        // validating request data
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'age' => 'nullable|integer',
            'attachment' => 'nullable|file',
        ]);

        // saving file in public storage
        $attachment = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment')->store('attachments', 'public');
        }

        // creating news
        $news = News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'age' => $validated['age'],
            'attachment' => $attachment,
            'admin_id' => $admin_id, 
        ]);

        return response()->json([
            "message" => "News created successfully",
            "news" => $news
        ]);
    }
}
