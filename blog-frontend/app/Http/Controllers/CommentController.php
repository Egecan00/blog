<?php

namespace App\Http\Controllers;


use App\models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Http sınıfını ekleyin
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{

    // public function index($id)
    // {
    //     $token = session('api_token');
        
    //     if (!$token) {
    //         return redirect('/index')->with('error', 'Lütfen giriş yapınız.');
    //     }

    //     $response = Http::timeout(1000)->withToken($token)->get('http://nginx_api/api/blog/'.$id);

    //     $comment= $response->json();

    //     return view('blog.show', compact('comment'));

    // }

    // public function store($id)
    // {
    //     $token = session('api_token');
    //     // $response = Http::timeout(1000)->withToken($token)->post('http://nginx_api/api/blog/'.$id);
    //     $response = Http::timeout(1000)->withToken($token)->post("http://nginx_api/api/blog/{$id}/comments");

    //     $post= $response->json();

    //     return view('blog.show',[
    //         'post' => $post,
    //         'comments'=> $post['comments'] ?? []
    //     ]);
        
    // }
    
}
