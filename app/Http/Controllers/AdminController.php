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

    }
}
