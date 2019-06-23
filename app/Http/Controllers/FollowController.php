<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;

class FollowController extends Controller
{
        //保存と削除
        public function followStoreDel(Request $request)
    {

    	if($request->flag==='add'){
    	//いいね書き込み
    		$follow = new Follow();
    		$follow->user_id=auth::id();
    		$follow->follow_id=$request->item;
    		$follow->save();

    	}elseif($request->flag==='rm'){
    	 //いいね削除
    		$user_id = auth::id();
      		$follow_id = $request->item;
    		$follow = Follow::where('user_id',$user_id)->where('follow_id',$follow_id);
    		$follow->delete();
    	}

    	//いいね数の取得
    	$res = array ( 'process' => 'ok' );
    	$res = json_encode($res);
    	return $res;
    }
}
