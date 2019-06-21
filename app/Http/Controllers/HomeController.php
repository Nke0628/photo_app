<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    //一覧表示
    public function index()
    {
        //データ取得、ビュー表示
        $user_id = Auth::id();
        $posts = Post::where('user_id',$user_id)->get();

        //お気に入り取得
        $favorite_posts = Like::where('user_id',$user_id)->get();

        return view('home.home',compact('posts','favorite_posts'));

    }

    //詳細表示
    public function show($id){

        $post = Post::find($id);
        return view('home.show',compact('post'));

    }

    //ダウンロード
    public function download($id){
        $post = Post::find($id);
        $path='storage/'.$post->file_name;
        return response()->download($path);
    }

    //削除(Likeも消す)
    public function destroy($id){

        //投稿削除
        $post = Post::find($id);
        $post->delete();

        //お気に入り削除
        Like::where('post_id',$id)->delete();

        return redirect('/home');
    }

    //マイページ
    public function showMypage(){
        return view('home.mypage');
    }
}
