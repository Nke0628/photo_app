@extends('layouts.app')

@section('content')

<div class="home-profile mb-5" style="height: 250px; background-image: url({{asset('storage/moon.jpg')}});
padding-top: 0; opacity:0.9;color: white;text-align: center;">
    <div class="container">
        <div class="row">
            <h5 class="col-md-2 offset-md-5 mt-5">{{ $user->name }}</h5>
        </div>
        @if($user->user_image)test
        <img src="{{ asset('storage/icon/'. $user->user_image)}}" style="width:100px; height:100px;  border-radius:100px;">
        @else
        <img src="{{ asset('storage/icon/person.png')}}" style="width:100px; height:100px;  border-radius:100px;" >
        @endif
        <div class="row mt-2">
            <p class="mx-auto">
            {{$follow_count}}フォロー
            {{$follower_count}}フォロワー</p>
        </div>
    </div>
</div>

<!--写真投稿-->
<div class="container">
    @if (session('flash_message'))
        <div class="flash_message bg-success text-center py-3 my-0">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-2">
            <p>写真をアップロードする</p>
        </div>
    </div>
    <form class="form-group" method="post" action="{{url('posts')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-1">
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-1">
            <input type="file" name="photo" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 mb-3">
             <input type="submit" name="submit" value="投稿" class="btn btn-success">
            </div>
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="home-contents">
    <div class="container">
         <div class="row">
            <div class="col-md-2">
                <span class="home-button photo">写真一覧</span>
            </div>
            <div class="col-md-2">
                <span class="home-button favorite">お気に入り</span>
            </div>
         </div>
         <div class="row photo-list">
            @foreach($posts as $post)
                <div class="col-md-4 col-sm-6 col-12 offset-1 offset-md-0 offset-sm-0">
                    <a href="{{ url('home/'.$post->id)}}"><img class="img-fluid" src="{{ asset('storage/' . $post->file_name) }}" style="margin-top: 20px; width: 300px; height: 200px;"></a>
                </div>
            @endforeach
        </div>
        <div class="row favorite-list">
            @foreach($favorite_posts as $post)
                <div class="col-md-4 col-12">
                    <a href="{{ url('home/'.$post->post->id)}}"><img class="img-fluid" src="{{ asset('storage/'. $post->post->file_name) }}" style="margin-top: 20px;"></a>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
