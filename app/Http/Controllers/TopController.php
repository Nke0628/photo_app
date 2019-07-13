<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\PostService;
use App\Post;


class TopController extends Controller
{
    protected $postservice;

    //投稿系のサービス層をDIする
    public function __construct(PostService $postservice)
    {
        $this->postservice = $postservice;
    }

    //一覧表示
    public function index()
    {
    	//TOPは最初９枚取得する
        $posts = Post::take(12)->get();
        //各画像幅の調整
        $posts = $this->postservice->ajustWidth($posts);

        return view('welcome',compact('posts'));
    }
}
