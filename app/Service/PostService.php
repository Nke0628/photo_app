<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class PostService
{
	//画像幅をランダムに(一行に4枚)、widthをプロパティに追加
	public function ajustWidth($data)
	{
		
        $count = 1;
        $total = 0;

        //画像枚数だけループ
        foreach($data as $post){

        	//1,2,3枚目位はランダムな大きさ、４枚目は残りの大きさを割り当てる
            if($count == 4 ){
                $width = 1100 - $total;
            }else{
                $width = rand(230,300);
                $total = $total + $width;
            }

            //プロパティに追加
            $post->width=$width;

            //４枚になったらカウントをリセット
            if($count == 4){
                $count = 0;
                $total=0;
            }
            $count++;
        }

        return $data;
	}

	//いいね数をプロパティに追加
	public function addGood($data)
	{
        foreach($data as $post){
            $like = DB::table('likes')->where('post_id',$post->id)->count();
            $post->like=$like;
        }

        return $data;
	}

	//連番をプロパティに追加
	public function addSeqno($data)
	{
		//連番をプロパティに追加
        $no = 1;
        foreach($data as $post){
            $post->no = $no;
            $no = $no + 1;
        }

        return $data;
	}

	//画像保存時の名前作成
	public function makePhotoName($request)
	{
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

    	return $file_name;
	}
}

