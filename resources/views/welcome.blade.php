<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Photobase</title>

        <!-- Fonts&Bootstprap -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">


        <!-- Styles -->
        <link href="{{ asset('/css/welcome.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>

        <nav class="navbar navbar-expand-md  navbar-light p-4" style="background-color: white;">
                            <ul class="navbar-nav mr-auto">
                    <li class="nav-item title"><a class="nav-link" href="/">PhotoBase</a></li>
                </ul>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#bs-navi" aria-controls="bs-navi" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
             </button>
  
            <div class="collapse navbar-collapse" id="bs-navi">
                <ul class="navbar-nav mr-auto">
                </ul>
                @if (Route::has('login'))
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        写真を探す
                        <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/posts')}}">
                                一覧
                            </a>
                            <a class="dropdown-item" href="{{ url('/trend')}}">
                                トレンド
                            </a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">HOME</a></li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        写真を探す
                        <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/posts')}}">
                                一覧
                            </a>
                            <a class="dropdown-item" href="{{ url('/trend')}}">
                                トレンド
                            </a>
                        </div>
                    </li>                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">登録</a></li>
                    @endauth
                </ul>
                @endif
            </div>
        </nav>

        <div id="search">
            <div class="container">
                <h2>美しいフリー写真をみていこう</h2>
                <form method="get" action="{{ url('/search' )}}">
                    <div class="form-group form-inline">
                        <input class="search-text form-control col-md-7 offset-md-2" type="text" placeholder="キーワード(例:自然)" name="keyword">
                        <input class="search-button form-control col-md-1" type="submit" name="submit" value="検索">
                    </div>
                </form>
                </div>
                <p>Let'share photos</p>
                <p>写真を共有しましょう</p>
            </div>
        </div>

        <div id="top-photo">
            <div class="container">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="mx-auto hover-effect" style="margin-top:20px">
                            <a class="ph-style-base" href="{{ url('posts/'.$post->id)}}">
                            <img class="ph-style img-flud" src="{{ asset('storage/' . $post->file_name) }}" width="300px" height="200px">
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
                
                <button type="button" class="btn btn-success mb-5 mt-5" onclick="moreLook()">もっと写真を見る</button>
                <input type="hidden" class="photo-param" value="1">
            </div>
        </div>

        <div id="top-signup">
            <div class="container mt-5">
                <div class="row mb-4">
                    <div class="mx-auto">
                        <h2>PhotoBaseに登録する</h2>
                    </div>  
                </div>
                <div class="row mb-4 mx-2">
                        <p class="mx-auto" >登録して色々な人共有しましょう。コメントやお気に入り登録もできるようになります。</p>
                </div>
                <div class="row mb-5">
                    <a  class="mx-auto m" href="{{ route('register') }}"><button class="btn btn-success" href="po">サインアップする！</button></a>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <span class="logo">PhotoBase</span>
                    </div>
                    <div class="col-md-4 col-12">
                        <ul class="menu">
                            <span>Menu</span>    
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">About</a>
                            </li>           
                            <li>
                                <a href="#">Blog</a>
                            </li>          
                            <li>
                                <a href="#">Gallery </a>
                            </li>
                        </ul>
                    </div>
                   
                    <div class="col-md-4 col-12">
                        <ul class="address">
                            <span>Contact</span>       
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i> <a href="#">Phone</a>
                            </li>
                            <li>
                                <i class="fa fa-map-marker" aria-hidden="true"></i> <a href="#">Adress</a>
                            </li> 
                            <li>
                                <i class="fa fa-envelope" aria-hidden="true"></i> <a href="#">Email</a>
                            </li> 
                        </ul>
                    </div>
                 </div> 
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{ asset('/js/post.js') }}"></script>
    </body>
</html>
