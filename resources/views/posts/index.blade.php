@extends('layouts.app')

@section('content')
{{$test}}
    <div class="container mt-5">
         <div class="row">
            <div class="col-md-1">
                <p>一覧</p>
            </div>
         </div>
        <div class="row">
            @foreach($posts as $post)
                <div class="hover-effect test mt-1 mr-1">
                    <a class="test2 ph-style-base mx-auto" href="{{ url('posts/'.$post->id)}}" style="height: 200px; width:{{$post->width}}px">
                    <img class="test3" src="{{ asset('storage/' . $post->file_name) }}" style="height: 200px; width:{{$post->width}}px">
                        <div class="mask">
                            <div class="caption">
                                {{$post->title}}<br>
                                <i class="far fa-heart"></i>
                                {{$post->likes->count()}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
