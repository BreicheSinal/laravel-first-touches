<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     // checking if user && admin
     private function check_admin($admin_id){
         $user = User::find($admin_id);
         if (!$user || $user->role !== 'admin') {
             return response()->json([
                 'error' => 'Unauthorized: User is not an admin'
             ], 403);
         }

        // null if admin
        return null;
     }

    function post_news(Request $request, $admin_id){
        //admin check before proceeding
        $adminCheck = $this->check_admin($admin_id);
        if ($adminCheck) return $adminCheck;  
        

        // validating request data
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'age' => 'nullable|integer',
        ]);

        // saving file in public storage
        $attachment = $request->hasFile('attachment') 
        ? $request->file('attachment')->store('attachments') 
        : null;

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

    public function edit_news(Request $request,  $admin_id, $id){
        //admin check before proceeding
        $adminCheck = $this->check_admin($admin_id);
        if ($adminCheck) return $adminCheck; 

        $news = News::findOrFail($id);

        // validating request data
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'age' => 'nullable|integer',
        ]);

        // saving file in public storage
        $attachment = $request->hasFile('attachment') 
        ? $request->file('attachment')->store('attachments') 
        : null;

        // updating news 
        $news->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'age' => $validated['age'],
            'attachment' => $attachment,
        ]);

        return response()->json([
            "message" => "News updated created successfully",
            "updated_news" => $news
        ]);

    }

    public function delete_news($admin_id, $id){
        //admin check before proceeding
        $adminCheck = $this->check_admin($admin_id);
        if ($adminCheck) return $adminCheck; 

        $news = News::findOrFail($id);

        // deleting newd
        $news->delete();

        return response()->json([
            'message' => 'News deleted successfully'
        ]);
    }
}
