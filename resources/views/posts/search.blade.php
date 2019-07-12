@extends('layouts.app')

@section('content')
    <div class="container mt-5">
         <div class="row">
            <div class="col-12">
                <form method="get" action="{{ url('/search' )}}">
                    <div class="form-group form-inline">
                        <input class="search-text form-control col-md-7 offset-md-2" type="text" placeholder="キーワード(例:自然 山) スペース区切りで入力" name="keyword">
                        <input class="search-button form-control col-md-1" type="submit" name="submit" value="検索">
                    </div>
                </form>
                <p>「{{$keyword}}」の検索結果が {{$posts->count()}} 件見つかりました。</p>
            </div>
         </div>
         <div class="row">
            @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 col-12 hover-effect" style="margin-top:20px;">
                    <a class="ph-style-base mx-auto" href="{{ url('posts/'.$post->id)}}">
                    <img class="ph-style" src="{{ asset('storage/' . $post->file_name) }}" style="width: 300px; height: 200px;">
                        <div class="mask">
                            <div class="caption">
                                {{$post->title}}<br>
                                <i class="far fa-heart"></i>
                                {{$post->like}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
