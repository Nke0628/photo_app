@extends('layouts.app')

@section('content')
<div id="profile">
	<div class="container">
		<div class="row">
	 		<h5 class="col-md-2 offset-md-5 mt-2 mb-5">プロフィール</h5>
		</div>
    	<img src="{{ asset('storage/icon/'. $user->user_image)}}" >
    	<form class=" justify-content-center" method="post" action="{{ url('/mypage/icon') }}" enctype="multipart/form-data">
    		@csrf
    		<input type="file" name="icon" class="form-control-file col-md-5 offset-md-5 mt-2">
    		<div class="row">
    		<input type="submit" name="submit" value="アイコンを変更" class="form-control col-md-2 offset-md-5 mt-2">
    		</div>
    	</form>
	</div>

	<div class="container">
		<form method="post" action="{{ url('/mypage/profile') }}">
			@csrf
			<div class="row">
	  			<span class="col-md-2 offset-md-5 mt-5">ユーザ名</span>
			</div>
			<input type="text" name="name" value="{{$user->name}}" class="form-control col-md-2 offset-md-5 mt-1">
			<div class="row">
	  			<span class="col-md-2 offset-md-5 mt-4">メールアドレス</span>
			</div>
			<input type="text" name="email" value="{{$user->email}}" class="form-control col-md-2 offset-md-5 mt-1">
			<div class="row">
			<button type="submit" class="btn btn-success col-md-2 offset-md-5 mt-5">更新する</button>
			</div>
		</form>
	</div>

</div>
@endsection
