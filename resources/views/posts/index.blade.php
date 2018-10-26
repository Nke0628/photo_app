@extends('layouts.app')

@section('content')
    <div class="container">
         <div class="row">
            <div class="col-md-1">
                <p>一覧</p>
            </div>
         </div>
         <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4" style="margin-top:20px">
                    <a class="ph-style-base" href="{{ url('posts/'.$post->id)}}">
                    <img class="ph-style" src="{{ asset('storage/' . $post->file_name) }}" width="300px" height="200px">
                    <p class="mask"> 
                        {{$post->likes->count()}}
                    </p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
