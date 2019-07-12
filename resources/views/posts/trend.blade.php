@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h5><i class="fas fa-chart-line"></i> トレンド</h5>
            </div>
        </div>

        <div class="row mt-5">
            @foreach($trends as $trend)
                <div class="offset-1 col-2">
                    <p><u class="bg-succsess">{{$trend->no}}位</u></p>
                </div>
                <div class="col-6 mb-5 hover-effect pr-0 pl-0">
                    <a href="{{ url('posts/'.$trend->id)}}">
                        <img class="img-fluid" src="{{ asset('storage/' . $trend->file_name) }}">
                        <div class="mask">
                            <div class="caption">
                                {{$trend->title}}<br>
                                <i class="far fa-heart"></i>
                                 {{$trend->rank}}</div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                </div>
            @endforeach
        </div>
    </div>
@endsection
