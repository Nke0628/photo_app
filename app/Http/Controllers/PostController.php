<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Service\PostService;
use App\Post;
use App\Follow;
use App\Likes;
use App\Tagmap;

class PostController extends Controller
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
        //一覧取得
        $posts = Post::all();
        //各画像幅の調整
        $posts = $this->postservice->ajustWidth($posts);

        return view('posts.index',compact('posts'));
    }

    //検索表示
    public function search(Request $request)
    {
        //対象の投稿を取得(検索条件:タイトルorタグに含まれる)
        $keyword = $request->keyword;
        $posts_tag = DB::table('posts')->join('tagmaps','posts.id','=','tagmaps.post_id')->join('tags','tags.id','=','tagmaps.tag_id')->where('tags.name',$keyword)->select('posts.*');
        $posts = DB::table('posts')->where('title','like','%'. $keyword . '%')->union($posts_tag)->get();
        //いいね数をプロパティに追加
        $posts = $this->postservice->addGood($posts);

        return view('posts.search',compact('posts','keyword'));     
    }

    //トレンド表示
    public function trend()
    {
        //TOP10を取得
        $trends = DB::table('posts')->join('likes','posts.id','=','likes.post_id')->selectRaw('posts.id,title,file_name,count(posts.id) as rank')->groupBy('posts.id','title','file_name')->orderBy('rank','desc')->take(10)->get();
        //連番をプロパティに追加
        $treds = $this->postservice->addSeqno($trends);

        return view('posts.trend',compact('trends'));
    }

    //写真詳細
    public function show($id)
    {

        $post = Post::find($id);
        //フォロ-情報を取得
        $follow = DB::table('follows')->where('user_id',auth::id())->where('follow_id',$post->user->id)->get();

        return view('posts.show',compact('post','follow'));

    }

    //写真投稿
    public function store(Request $request)
    {

        //バリデーション
        $request->validate([
            'title' => 'required',
            'photo' => 'required|file|image'
        ]);
        //ファイル名作成
        $file_name = $this->postservice->makePhotoName($request);
        //保存
        $request->file('photo')->storeAs('public',$file_name);

        //DB格納
        $post = new Post;
        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->file_name = $file_name;
        $post->save();

        //タグDB格納
        foreach($request->tags as $tag){
            $tagmap = new Tagmap;
            $tagmap->post_id = $post->id;
            $tagmap->tag_id = $tag;
            $tagmap->save();
        }

    	return redirect('/home')->with('flash_message','写真を投稿しました');
    }

    //もっと見る機能(ajax)
    public function moreLook(Request $request)
    {   
        //一回で12件取得する
        $page_number = $request->page_number;
        $next_offset = $page_number * 12;
        $posts = Post::skip($next_offset)->take(12)->get();
        //いいね数をプロパティに追加
        $posts = $this->postservice->addGood($posts);
        //各画像幅の調整
        $posts = $this->postservice->ajustWidth($posts);
        //jsonに変換
        $post = json_encode($posts);

        return $post; 
    }
}
