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

Route::middleware(['header'])->group(function () {



Route::get('/','Index\IndexController@index');  //前台首页
Route::get('/list/{id}','Index\ListController@list');  //列表页
Route::get('/confirm','Index\OrderController@index');  //提交订单视图页面

Route::get('/goods/{goods_id}','Index\GoodsController@goodsinfo');//详情
Route::post('/addcart','Index\CartController@addcart');//加入购物车
Route::get('/login','Index\LoginController@login');//登录


Route::get('/reg','Index\LoginController@reg');//注册
Route::get('/ser','Index\UserController@ser');//个人中心
Route::get('/cart','Index\CartController@cart');//头部购物车或购物车列表
Route::get('/favo','Index\FavoController@favo');//收藏
<<<<<<< HEAD
Route::post('/logdo','Index\LoginController@logindo');//执行登录
=======
Route::post('/logdo','Index\LoginController@logindo');//登录
Route::post('/cart_del','Index\CartController@cart_del');//购物车删除
Route::post('/buy_jian','Index\CartController@buy_jian');//购物车减号
Route::post('/buy_jia','Index\CartController@buy_jia');//购物车加号
Route::post('/cart_zprice','Index\CartController@cart_zprice');//购物车总价格







>>>>>>> 04ef5d967f84fb55355a5d039ea3de8d36b7dbee
});