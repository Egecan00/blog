<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendCommentNotificationToAdmin;


class PostController extends Controller
{

    public function index(Request $request)
    {
        $query = Post::with('categories','tags','comments')
        ->latest()
        ->published()
        ->where('status', true);

        
        if ($request->category) {
            $query->whereHas('categories', fn($q) => $q->where('name', $request->category));
        }

        if ($request->tag) {
            $query->whereHas('tags', fn($q) => $q->where('name', $request->tag));
        }

        $posts = $query->get();

        return response()->json([
            'posts' => $posts,
        ], 200);

    }

    public function show($id)
    {
      
        $post = Post::with(['categories', 'tags', 'comments' => function($query) {
            $query->where('status', true)->with('user')
            ->published()
            ->latest();
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

        dispatch(new SendCommentNotificationToAdmin($comment));
         
          return response()->json([
            'message'=>'Yorumunuz Gönderildi!',
            'comment'=> $comment
        ],200);

    }
        
}
