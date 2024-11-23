<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// admin routes
Route::prefix('admin/news')->group(function(){
    Route::post("/{admin_id}", [AdminController::class, "post_news"]);
    Route::put("/{admin_id}/{id}", [AdminController::class, "edit_news"]);
    Route::delete("/{admin_id}/{id}", [AdminController::class, "delete_news"]);
});