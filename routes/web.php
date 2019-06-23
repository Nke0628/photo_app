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

//トップページ
Route::get('/', 'TopController@index');

Auth::routes();

//写真表示
Route::get('/posts', 'PostController@index');
Route::get('/search', 'PostController@search');
Route::get('/posts/moreLook','PostController@moreLook');
Route::get('/posts/{id}','PostController@show');
Route::post('/posts', 'PostController@store');
Route::get('/posts/{id}/download','HomeController@download');

//マイページ
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}','HomeController@show');
Route::delete('/home/{id}/destroy','HomeController@destroy');
Route::get('/mypage' ,'HomeController@showMypage');
Route::post('/mypage/icon', 'HomeController@storeIcon');

//コメント機能
Route::post('/comments','CommentController@store');

//いいね機能
Route::post('/likes','LikeController@goodStoreDel');

//フォロー機能
Route::Post('/follows', 'FollowController@followStoreDel');
