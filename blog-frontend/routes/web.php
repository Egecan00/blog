<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PrivacyPolicyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', function () {
    return view('/blog.index');
}); 

Route::get('/index', function () {
    return view('/index');
}); 

Route::get('/signup', function () {
    return view('/signup');
}); 

Route::get('/login', function () {
    return view('/login');
}); 

Route::get('kvkk', [PrivacyPolicyController::class, 'showKvkk']);
Route::get('gizlilik-politikasi', [PrivacyPolicyController::class, 'showPrivacyPolicy']);

Route::put('profile',[ProfileController::class, 'update'])->name('profile.update');
Route::get('profile', [ProfileController::class, 'show']);
Route::get('/blog',[PostController::class,'index'])->name('blog.index');
Route::get('blog/{id}',[PostController::class,'show'])->name('blog.show');
// Route::post('blog/{id}',[PostController::class,'store'])->name('post.store');
Route::post('blog/{id}/comments',[PostController::class,'store'])->name('comments.store');


// Kayıt sayfası için rota
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Giriş sayfası için rota
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');




 
