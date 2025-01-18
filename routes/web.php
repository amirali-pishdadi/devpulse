<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OpenaiController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;


Route::feeds();

Route::get('/', function () {
    $articles = Article::with(['user', 'comments', "category"])->latest()->take(6)->get();
    $tags = Tag::latest()->take(6)->get();


    $mostPinnedArticles = Article::with(['user', 'comments', 'category'])
        ->where('is_pinned', true)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();


    return view('index', ["articles" => $articles, "tags" => $tags, "sliderArticles" => $mostPinnedArticles]);
});



Route::get("/search", [UserController::class, "searchPage"]);

Route::get("/about-us", function () {
    return view("about-us");
});
Route::get("/contact-us", function () {
    return view("contact-us");
});
Route::post("/send-email", [SettingController::class, "sendEmail"]);



//  Auth
Route::get('/login', [UserController::class, "login"])->middleware("guest")->name("login");
Route::post('/login', [UserController::class, "authenthicate"])->middleware("guest");
Route::get("/logout/{username}", [UserController::class, "logout"])->middleware("auth");
Route::get('/register', [UserController::class, "create"])->middleware("guest")->name("register");
Route::post('/register', [UserController::class, "store"])->middleware("guest");
Route::post('/send-code', [UserController::class, 'sendVerificationCode']);

// Forget Password

Route::get('password/forgot', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware("guest");
Route::post('password/forgot', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware("guest");

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showRestPasswordForm'])->name('password.reset.form')->middleware("guest");
Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.update')->middleware("guest");


// User
Route::get("/setting", [UserController::class, "setting"])->middleware("auth");
Route::get("/edit/user/{username}", [UserController::class, "edit"])->middleware("auth");
Route::put("/edit/user/{user}", [UserController::class, "update"])->middleware("auth")->name("edit-profile");
Route::post("/change-password", [UserController::class, "changePassword"])->middleware("auth")->name("change-password");
Route::post('/delete-account', [UserController::class, 'deleteAccount'])->name('deleteAccount');


// Blog
Route::post('/articles/{id}/like', [ArticleController::class, 'like'])->name('articles.like');
Route::get('/articles', [ArticleController::class, "index"]);
Route::get('/article/{slug}', [ArticleController::class, "show"])->name("articleShow");
Route::get('/create-article', [ArticleController::class, "create"])->middleware("admin");
Route::post('/create-article', [ArticleController::class, "store"])->middleware("admin");
Route::get('/delete-article/{slug}', [ArticleController::class, "destroy"])->middleware("admin");
Route::get('/articles/{slug}/edit', [ArticleController::class, 'edit'])->middleware("admin");
Route::put('/articles/{slug}', [ArticleController::class, 'update'])->middleware("admin");

// Comment
Route::post('/create-comment', [CommentController::class, "store"])->middleware("auth");

// Tags
Route::get('/tag/{name}', [TagController::class, "show"]);


// Category
Route::get('/category/{slug}', [CategoryController::class, "show"]);
