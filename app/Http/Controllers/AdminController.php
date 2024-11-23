<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function post_news(Request $request, $user_id){

        //checking if user exists
        $user = User::find($user_id);
        if (!$user) {
            return response()->json([
                'error' => 'User not found'], 
            404);
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

    }
}
