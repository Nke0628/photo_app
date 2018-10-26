<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//マイページ
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}','HomeController@show');
Route::get('/mypage' ,'HomeController@showMypage');
Route::delete('/home/{id}/destroy','HomeController@destroy');


//投稿関連
Route::get('/posts', 'PostController@index');
Route::get('/posts/{id}','PostController@show');
Route::post('/posts', 'PostController@store');
Route::get('/posts/{id}/download','HomeController@download');

//コメント書き込み
Route::post('/comments','CommentController@store');

//いいね機能
Route::post('/likes','LikeController@store_delete');
