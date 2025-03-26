<?php

namespace App\Http\Controllers;

use App\models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Http sınıfını ekleyin
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'content'=> 'required|string|max:255',
    //         'post_id'=> 'required|exists:post,id',
    //     ]);

    //     $comment = Comment::create([
    //        'content'=> $request->content,
    //        'status'=> false,
    //        'post_id'=>$request->post_id,
    //        'user_id'=>$request->user()->id,
    //     ]);

    //     //   return response()->json([
    //     //     'message'=>'Yorumunuz Gönderildi!',
    //     //     'data'=>new PostResource ($comment)
    //     // ],200);

    //    return back()->with('success','Yorumunuz Gönderildi!');

    // }
 
}
