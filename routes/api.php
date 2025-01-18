<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// User API 
Route::post("/register", [UserController::class, "store"])->middleware("guest");
Route::post("/login", [UserController::class, "authenthicate"])->middleware("guest");
Route::post("/logout", [UserController::class, "logout"])->middleware("auth:sanctum");
Route::post("/user/{id}", [UserController::class, "update"])->middleware("auth:sanctum");
Route::post("/delete/user/{id}", [UserController::class, "destroy"])->middleware("auth:sanctum");
Route::get("/user/show/{username}", [UserController::class, "index"]);

// Comment API
Route::get('article/comments/{slug}', [CommentController::class, "index"]);
Route::post('/create-comment', [CommentController::class, "store"])->middleware("auth:sanctum");
Route::put("/comments/{comment}", [CommentController::class, "update"])->middleware("auth:sanctum");
Route::delete("/comments/delete/{comment}", [CommentController::class, "destroy"])->middleware("auth:sanctum");

// Article API
Route::get("/articles", [ArticleController::class, "index"]);
Route::post("/create-article", [ArticleController::class, "store"])->middleware("auth:sanctum", "admin");
Route::get("/article/{slug}", [ArticleController::class, "show"]);
Route::delete("/delete/article/{slug}", [ArticleController::class, "destroy"])->middleware("auth:sanctum", "admin");
Route::put("/article/{slug}", [ArticleController::class, "update"])->middleware("auth:sanctum", "admin");

// Tag Api
Route::get('/tags', [TagController::class, "index"]);
Route::get('/tag/show/{slug}', [TagController::class, "show"]);
Route::post('/create-tag', [TagController::class, "store"])->middleware("auth:sanctum", "admin");
Route::put("/tag/{slug}", [TagController::class, "update"])->middleware("auth:sanctum", "admin");
Route::delete("/delete/tag/{slug}", [TagController::class, "destroy"])->middleware("auth:sanctum", "admin");

