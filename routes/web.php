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

Route::get('/user/info','TestController@userInfo');
Route::get('/test2','TestController@test2');

Route::post('/user/login','TestController@login');


Route::post('/user/reg','User\IndexController@reg');//注册
Route::post('/user/login','User\IndexController@login');//登录
Route::post('/user/center','User\IndexController@center');//个人中心
