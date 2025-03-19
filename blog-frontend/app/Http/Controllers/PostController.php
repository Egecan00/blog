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
        $token = session('api_token');
        
        if (!$token) {
            return redirect('/index')->with('error', 'Lütfen giriş yapınız.');
        }
       
        $response = Http::withToken($token)
        ->get(env('API_URL') . '/blog',);

        // $response = Http::timeout(1000)->withToken($token)->get('http://nginx_api/api/blog');
        $posts = $response->json();
        return view('blog.index', compact('posts'));
    }

    public function show()
    {
        
    }
    
}
