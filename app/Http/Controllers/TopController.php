<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;


class TopController extends Controller
{
    //一覧表示
    public function index()
    {
        $posts = Post::take(9)->get();
        return view('welcome',compact('posts'));
    }
}
