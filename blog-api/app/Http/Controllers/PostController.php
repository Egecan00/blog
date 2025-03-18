<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Http sınıfını ekleyin
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    public function index()
    {
        // $posts = Post::orderBy('created_at','desc')->get();
        $post = Post::all();
        $post = Post::with('categories','tags')->get();

        return response()->json([
            'posts' => $post
        ], 200);
    }

    public function show()
    {
        
    }
    
}
