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


//access_token路由
Route::get('/wx/token','TestController@getwxToken');

//curl获取access_token
Route::get('/wx/token2','TestController@getwxToken2');

//使用Guzzle获取access_token

Route::get('/wx/token3','TestController@getGuzzleToken');

//自己生成token
Route::get('/api/token','TestController@getAccessToken');
