<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\PostResource;
 use Filament\Facades\Filament;

// Route::get('/product' , function() {
//     dd('hi');
// })->withoutMiddleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (){ //bu grubun içindeki tüm rotalar, yalnızca kimlik doğrulaması yapılmış kullanıcılar tarafından erişilebilir.
    // Route::resource('product', ProductController::class);
    // Route::apiResource('product',ProductController::class);

    Route::get('/blog',[PostController::class,'index'])->name('blog.index');
    Route::get('blog/{id}',[PostController::class,'show'])->name('blog.show');
    // Route::post('blog/{id}',[PostController::class,'store'])->name('post.store');
    Route::post('blog/{id}/comments',[PostController::class,'store'])->name('comments.store');  
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
 });

    Route::get('/', function () {
        return response()->json('E');
    });

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Filament::auth();











