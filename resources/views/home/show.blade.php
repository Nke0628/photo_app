@extends('layouts.app')

@section('content')
<div class="container">
    <p>「{{ $post->title }}」</p>
    <p>投稿日時{{ $post->created_at }}</p>
    <br>
    <img src="{{ asset('storage/' . $post->file_name) }}">
	<br>
	<br>
	<div class="row">
		<div class="col-md-2">
    		<form method="get" action="/posts/{{$post->id}}/download"> 
    		<input type="submit" value="ダウンロード" class="form-control">
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1">
			<form method="post" action="/home/{{$post->id}}/destroy">
			@method('delete')
			@csrf
    		<input type="submit" value="削除" class="form-control">
			</form>
		</div>
	</div>
</div>
@endsection
