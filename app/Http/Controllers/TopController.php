<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;


class TopController extends Controller
{
    //一覧表示
    public function index()
    {
    	//TOPは最初９枚取得する
        $posts = Post::take(9)->get();
        return view('welcome',compact('posts'));
    }
}
