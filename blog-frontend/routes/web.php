<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\RegisterController;

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


Route::get('/blog',[PostController::class,'index'])->name('blog.index');





// Kayıt sayfası için rota
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Giriş sayfası için rota
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');




 
