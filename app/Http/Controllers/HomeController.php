<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Like;
use App\User;
use App\Follow;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }


    //一覧表示
    public function index()
    {
        //データ取得、ビュー表示
        $user_id = Auth::id();
        $posts = Post::where('user_id',$user_id)->get();

        //ユーザー取得
        $user = User::find(Auth::id());

        //フォロー、フォロワー数
        $follow_count = Follow::where('user_id',Auth::id())->count();
        $follower_count = Follow::where('follow_id',Auth::id())->count();       

        //お気に入り取得
        $favorite_posts = Like::where('user_id',$user_id)->get();

        //タグ取得
        $tags = DB::table('tags')->get();

        return view('home.home',compact('posts','favorite_posts','user','follow_count','follower_count','tags'));

    }

    //詳細表示
    public function show($id)
    {

        $post = Post::find($id);
        return view('home.show',compact('post'));

    }

    //ダウンロード
    public function download($id)
    {
        $post = Post::find($id);
        $path='storage/'.$post->file_name;
        return response()->download($path);
    }

    //削除(Likeも消す)
    public function destroy($id)
    {

        //投稿削除
        $post = Post::find($id);
        $post->delete();

        //お気に入り削除
        Like::where('post_id',$id)->delete();

        return redirect('/home');
    }

    //設定ページ
    public function showMypage()
    {
        $user = User::find(Auth::id());
        return view('home.mypage',compact('user'));
    }

    //アイコン保存
    public function storeIcon(Request $request){
            //バリデーション
        $request->validate([
            'icon' => 'required|file|image'
        ]);

        //すでにアイコンを設定している場合は削除
        //$user = User::find(Auth::id());
        //if(!empty($user->user_image)){
           // Storage::delete($user->user_image);
        //}

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
        if(preg_match('/jpg$/', $request->file('icon')->getClientOriginalName())){
            $file_name .= '.jpg';
        }
        else {
            $file_name .= '.png';
        }

        //保存
        $request->file('icon')->storeAs('public/icon',$file_name);

        //DB格納
        $user = User::find(Auth::id());
        $user->user_image = $file_name;
        $user->save();

        return redirect('/mypage');
    }

}
