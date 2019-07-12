@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <p>「{{ $post->title }}」</p>
    <p>投稿日時{{ $post->created_at }}</p>
    @auth
		<div class="good">
			@if($post->likes->where('post_id',$post->id)->where('user_id',auth::id())->count()>=1)
    			<i class="fas fa-heart fa-2x good color-red" onclick="rmaddGood()"></i>
    		@else
    		 	<i class="fas fa-heart fa-2x good" onclick="rmaddGood()"></i>
    		@endif
    		<span class="good-count">{{ $post->likes->count()}}</span>
    		<input  class="post-id" type="hidden" value="{{ $post->id }}">
    	</div>
    @else
    	<div>
    		<i class="fas fa-heart fa-2x"></i><a href="/login">ログインしてお気に入りに登録する</a>
    	</div>
    @endauth
    <br>

    <!-- 投稿ユーザ部分 -->
    <div class="row">
        <div class="col-12 col-md-8 hover-effect pr-md-0 pl-md-0">
    	   <img class="img-fluid" src="{{ asset('storage/' . $post->file_name) }}">
                <div class="mask">
                    <div class="caption">
                        {{$post->title}}<br>
                        <i class="far fa-heart"></i>
                        {{$post->likes->count()}}<br>
                        by {{$post->user->name}}
                    </div>
                </div>
        </div>
        <div class="col-12 col-md-3 ml-md-3 mt-4 mt-md-0">
        	<div class="row ml-2 ml-md-0">
        	@if($post->user->user_image)
        		<img src="{{ asset('storage/icon/'. $post->user->user_image)}}" class="" style="width:50px; height:50px;  border-radius:50px;">
        	@else
        		<img src="{{ asset('storage/icon/person.png')}}" class="" style="width:50px; height:50px;  border-radius:50px;" >
        	@endif
                <div class="col-4 col-md-2">
                    <div class="row">
                        <div class="col-12">
        		           {{$post->user->name}}
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12">
                            @auth
                                @if($post->user->id === auth::id())
                                @else
                                    @if($follow->count()>0)
                                        <button class="btn btn-secondary follow disabled" onclick="rmaddFollow()">✔︎フォロー</button>
                                    @else
                                        <button class="btn btn-secondary follow" onclick="rmaddFollow()">フォロー</button>
                                    @endif
                                @endif
                            @else
                                <a href="{{url('/login')}}"><button class="btn btn-secondary follow">フォロー</button></a>
                            @endauth
                            <input type="hidden" class="follow-id" value="{{$post->user->id}}">
                        </div>
                    </div>
                </div>
        	</div>
        	<div class="row mt-5">
        		<div class="col-12 col-md-12">
    				<form method="get" action="/posts/{{$post->id}}/download">
    				<input type="submit" value="ダウンロード" class="form-control bg-success text-white" style="cursor: pointer;">
					</form>
				</div>
			</div>
            <div class="row mt-5">
                <div class="col-12 col-md-12">
                    <a href="https://px.a8.net/svt/ejp?a8mat=35JHN7+ASS2SY+447K+C2GFL" target="_blank" rel="nofollow">
                    <img border="0" width="350" height="160" alt="" src="https://www20.a8.net/svt/bgt?aid=190705939653&wid=001&eno=01&mid=s00000019208002027000&mc=1"></a>
                    <img border="0" width="1" height="1" src="https://www17.a8.net/0.gif?a8mat=35JHN7+ASS2SY+447K+C2GFL" alt="">
                </div>
            </div>
    	</div>
	</div>

	<br>
	<div class="row">
		<div class="col-md-4">
		<p>コメント</p>
		</div>
	</div>
	@foreach($post->comments as $comment)
		<div class="row mt-3">
			<div class="col-2 col-md-1 pt-3 border-top"> 
        		<img src="{{ asset('storage/icon/'. $comment->user->user_image)}}" style="width:50px; height:50px;  border-radius:100px;">
        	</div>
        	<div class="col-10 col-md-6 pt-3 border-top">
        		<div class="row"> 
        			<div class="col-12">
					{{$comment->user->name}}
					{{$comment->created_at}}
					</div>
				</div>
				<div class="row">
					<div class="col-12"> 
					{{$comment->comment}}
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<br>
	@auth
	<div class="row">
		<div class="col-md-5">
    		<form method="post" action="/comments">
    		@csrf
      		<input type="hidden" name="id" value="{{ $post->id }}"> 		
      		<textarea name="comment" rows="4" cols="49" class="form-control"></textarea>
    		<input type="submit" value="コメントを残しましょう" class="form-control">
			</form>
		</div>
	</div>
	@else

	@endauth
</div>
@endsection
