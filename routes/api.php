<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::domain('2001.shop.api.com')->group(function () {
    Route::get('sendSMS','Api\LoginController@sendSMS');//注册
    Route::post('regdo','Api\LoginController@regdo');//执行注册
    Route::any('/','Api\IndexController@index');   //前台首页
    Route::any('goods','Api\GoodsController@goods');//详情
    Route::post('logindo','Api\LoginController@logindo');//执行登录
    Route::get('cart','Api\CartController@cartdata'); //购物车列表数据
    Route::get('cart_count','Api\CartController@cart_count'); //购物车数据条数


});

  

