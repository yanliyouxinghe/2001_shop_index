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

    Route::get('goods/{goods_id}','Api\GoodsController@goods');//详情
    Route::post('addcart','Api\CartController@addcart');//加入购物车
    Route::any('cartgory','Api\IndexController@cartgory'); //首页菜单栏分类数据
    Route::any('slideshow','Api\IndexController@slideshow'); //首页商品表轮播图数据
    Route::get('goodsInfo','Api\IndexController@goodsInfo'); //首页商品表数据

    Route::post('logindo','Api\LoginController@logindo');//执行登录<<<<<<< HEAD

    Route::get('cart','Api\CartController@cartdata'); //购物车列表数据
    Route::get('cart_count','Api\CartController@cart_count'); //购物车数据条数
});

  

