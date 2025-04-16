<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $token = session('api_token');
        
        if (!$token) {
            return redirect('/index')->with('error', 'Lütfen giriş yapınız.');
        }
       
        $response = Http::withToken($token)
        ->get(env('API_URL') . '/blog',[
            'category' => $request->category,
            'tag' => $request->tag
        ]);

        
        $posts = $response->json();
        return view('blog.index', compact('posts'));
       
    }

    public function show($id)
    {
        $token = session('api_token');
        
        if (!$token) {
            return redirect('/index')->with('error', 'Lütfen giriş yapınız.');
        }

      

        $response = Http::timeout(1000)->withToken($token)->get('http://nginx_api/api/blog/'.$id);

        $id= $response->json();
       

        return view('blog.show',[
            'post' => $id,
            'comments'=> $id['comments'] ?? []
        ]);

    }

    public function store(Request $request,$id)
    {
        $token = session('api_token');

        $response = Http::timeout(1000)->withToken($token)->post("http://nginx_api/api/blog/{$id}/comments",[
            'content'=> $request->input('content'),
            'post_id'=> $id
        ]);
        

        $postResponse = Http::timeout(1000)->withToken($token)->get("http://nginx_api/api/blog/{$id}");
        $post = $postResponse->json();
      

        return view('blog.show',[
            'post' => $post,
            'comments'=> $post['comments'] ?? []
        ]);
        
    }
    
}
