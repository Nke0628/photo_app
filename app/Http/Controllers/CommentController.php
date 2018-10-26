<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
	//コメント書き込み
    public function store(Request $request){
    	$comment = new Comment;
    	$comment->user_id = Auth::id();
    	$comment->post_id = $request->id;
    	$comment->comment = $request->comment;
    	$comment->save();

    	return redirect('/posts/'.$request->id);

    }
}
