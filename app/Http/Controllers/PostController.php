<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{
    //一覧表示
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    //写真詳細
    public function show($id)
    {

        $post = Post::find($id);
        return view('posts.show',compact('post'));

    }

    //写真投稿
    public function store(Request $request)
    {

        //バリデーション
        $request->validate([
            'title' => 'required',
            'photo' => 'required|file|image'
        ]);

        //写真保存
        //ファイルネームはランダムな１２桁から作成する
    	$characters = array_merge(
        	range(0, 9), range('a', 'z'),
         	range('A', 'Z'), ['-', '_']
        );
        $length=count($characters);
        $file_name='';
        for($i = 0 ; $i < 12 ; $i++){
            $file_name .=$characters[random_int(0,$length-1)];
        }

        //jpgかpngにする
        if(preg_match('/jpg$/', $request->file('photo')->getClientOriginalName())){
            $file_name .= '.jpg';
        }
        else {
            $file_name .= '.png';
        }
        //保存
        $request->file('photo')->storeAs('public',$file_name);

        //DB格納
        $post = new Post;
        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->file_name = $file_name;
        $post->save();

    	return redirect('/home')->with('flash_message','写真を投稿しました');
    }

    //もっと見る機能
    public function moreLook(Request $request)
    {   
        //一回で9件取得する
        $page_number = $request->page_number;
        $next_offset = $page_number * 9;
        $posts = Post::skip($next_offset)->take(9)->get();
        $post = json_encode($posts);
        return $post; 
    }
}
