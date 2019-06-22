<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;

class LikeController extends Controller
{
	//保存
    public function goodStoreDel(Request $request)
    {

    	if($request->flag==='add'){
    	//いいね書き込み
    		$id = $request->item;
    		$like = new Like();
    		$like->user_id=auth::id();
    		$like->post_id=$id;
    		$like->save();

    	}elseif($request->flag==='rm'){
    	 //いいね削除
    		$id = $request->item;
    		$user_id = auth::id();
    		$like = Like::where('post_id',$id)->where('user_id',$user_id);
    		$like->delete();
    	}

    	//いいね数の取得
    	$good_count = Like::where('post_id',$id)->count();
    	$res = array ( 'good_count' => $good_count );
    	$res = json_encode($res);
    	return $res;
    }

}
