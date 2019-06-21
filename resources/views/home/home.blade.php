@extends('layouts.app')

@section('content')
</div>
<div class="container">
    <form class="form-group" method="post" action="{{url('posts')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            <input type="file" name="photo" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
             <input type="submit" name="submit" value="投稿" class="form-control">
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
                <div class="col-md-4">
                    <a href="{{ url('home/'.$post->id)}}"><img src="{{ asset('storage/' . $post->file_name) }}" width="300px" height="200px" style="margin-top: 20px;"></a>
                </div>
            @endforeach
        </div>
        <div class="row favorite-list">
            @foreach($favorite_posts as $post)
                <div class="col-md-4">
                    <a href="{{ url('home/'.$post->post->id)}}"><img src="{{ asset('storage/'. $post->post->file_name) }}" width="300px" height="200px" style="margin-top: 20px;"></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
