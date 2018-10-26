@extends('layouts.app')

@section('content')
<div class="container">
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
    <img src="{{ asset('storage/' . $post->file_name) }}">
	<br>
	<br>
	<div class="row">
		<div class="col-md-4">
    		<form method="get" action="/posts/{{$post->id}}/download">
    		<input type="submit" value="ダウンロード" class="form-control">
			</form>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-4">
		<p>コメント</p>
		</div>
	</div>
	@foreach($post->comments as $comment)
		<div class="row">
			<div class="col-md-5"> 
			{{$comment->user->name}}<br>
			{{$comment->comment}}<br>
			{{$comment->created_at}}<br><br>			
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
    		<input type="submit" value="書き込む" class="form-control">
			</form>
		</div>
	</div>
	@else

	@endauth
</div>
@endsection
