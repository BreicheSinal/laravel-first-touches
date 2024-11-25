<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// admin routes
Route::prefix('admin/news')->group(function(){
    Route::post("/{admin_id}", [AdminController::class, "post_news"]);
    Route::put("/{admin_id}/{id}", [AdminController::class, "edit_news"]);
    Route::delete("/{admin_id}/{id}", [AdminController::class, "delete_news"]);
});

// users routes
Route::prefix('users/news')->group(function(){
    Route::get("/", [UserController::class, "get_news"]);
    Route::post("/{user_id}/{news_id}", [UserController::class, "post_article"]);
});