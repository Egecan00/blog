<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Http sınıfını ekleyin
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{

    public function index()
    {
        // $posts = Post::orderBy('created_at','desc')->get();
        // $post = Post::all();
        $post = Post::with('categories','tags','comments')->get();
        $post = Post::where('status',true)->latest()->get();
        // $comment = Comment::where('status',true)->latest()->get();
      
        return response()->json([
            'posts' => $post,
            // 'comments' => $comment
        ], 200);

    }

    public function show($id)
    {
      
        $post = Post::with(['categories', 'tags', 'comments' => function($query) {
            $query->where('status', true)->with('user')->latest(); 
        }])->findOrFail($id);

        return response()->json($post);
       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'content'=> 'required|string|max:255',
            'post_id'=> 'required|exists:posts,id',
        ]);

        $comment = Comment::create([
           'content'=> $request->content,
           'status'=> false,
           'post_id'=>$request->post_id,
           'user_id'=>$request->user()->id,
        ]);
        

          return response()->json([
            'message'=>'Yorumunuz Gönderildi!',
            'comment'=> $comment
        ],200);

    //    return back()->with('success','Yorumunuz Gönderildi!');

    }
        
}
