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
        $posts = Post::take(12)->get();


        //画像幅をランダムに散らす
        //widthをプロパティに追加
        $count = 1;
        $total = 0;

        foreach($posts as $post){

            if($count == 4 ){
                $width = 1100 - $total;
            }else{
                $width = rand(200,300);
                $total = $total + $width;
            }

            $post->width=$width;

            if($count == 4){
                $count = 0;
                $total=0;
            }

            $count++;
        }
        return view('welcome',compact('posts'));
    }
}
