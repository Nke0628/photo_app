<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .title {
                font-size: 30px;
                position: absolute;
                left:  100px;
                top: 18px;
                color: #333333;
            }

            .links > a {
                color: #333333;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            header{
                color: #333333;
                height: 100px;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .top-right {
                position: absolute;
                right: 100px;
                top: 18px;
            }

            /* 検索セクション*/
            #search{
                background-image: url({{asset('storage/tetwe.png')}});
                background-size:cover;
                height:500px;  
            }

            #search > .container{
                vertical-align: middle;
                text-align: center;
                color: white;
            }

            .search-text{
                width:600px;
                height: 40px;
                margin-top: 200px;
            }

            .search-button{
                width: 30px;
                height: 40px;
            }

            /**/
            #photo{
                display: block;
                clear: both;
            }
            .image1{
                display: block;
                float: left;
                width: 50%;
                height: 400px;
                background-size: cover;
                background-image: url({{asset('storage/coffee2.jpg')}});
            }

            .image1 > img{
                width:auto;
                height: auto;
            }

            .image2{
                display: block;
                float: right;
                width: 50%;
                height: 400px;
            }

            .image3{
                display: block;
                float: left;
                width: 50%;
                height: 400px;
                background-size: 100% auto;
                background-image: url({{asset('storage/coffee2.jpg')}});
            }

            .image4{                
                display: block;
                float: right;
                width: 50%;
                height: 400px;
                background-size: cover;
                background-image: url({{asset('storage/coffee2.jpg')}});
            }

            .m-b-md {
                margin-bottom: 30px;
            }

        </style>
    </head>
    <body>
        <header>
            <div class="title">
                PhotoBase
            </div>
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/posts') }}">写真</a>
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/posts') }}">写真</a>
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        <div id="search">
            <div class="container">
                <form  method="post" action="{{ url('/posts' )}}">
                <input class="search-text" type="text" placeholder="キーワード(例：人)" name="keyword">
                <input class="search-button" type="submit" name="submit" value="検索">
                </form>
                <p>Let'share photos</p>
                <p>写真を共有しましょう</p>
                <a href="{{ url('/posts') }}">一覧</a>
            </div>
        </div>

        <div id="category">
            <div class="container">
                <h3>カテゴリ</h3>
            </div>
        </div>


        <!--
        <div id="photo">
            <div class="image1">
                <img src="{{ asset('storage/coffee2.jpg') }}">
            </div>
            <div class="image2">
                <div class="image3">
                </div>
                <div class="image4">
                </div>
            </div>
        </div>
    -->

    </body>
</html>
