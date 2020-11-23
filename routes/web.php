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
Route::post('/address_del','Index\OrderController@address_del');  //收货地址ajax删除

Route::get('/goods/{goods_id}','Index\GoodsController@goodsinfo');//详情
Route::post('/addcart','Index\CartController@addcart');//加入购物车
Route::get('/login','Index\LoginController@login');//登录


Route::get('/reg','Index\LoginController@reg');//注册
Route::get('/ser','Index\UserController@ser');//个人中心
Route::get('/address','Index\UserController@address');//收货地址
Route::get('/cart','Index\CartController@cart');//头部购物车或购物车列表
Route::get('/favo','Index\FavoController@favo');//收藏
Route::post('/logdo','Index\LoginController@logindo');//执行登录
Route::get('/order','Index\OrderController@order');//订单
Route::get('/profile','Index\ProfileController@profile');//个人资料
Route::get('/changepass','Index\ProfileController@changepass');//修改密码


Route::get('/reg','Admin\BusinessController@reg');//商家后太注册
Route::get('/business','Admin\BusinessController@business');//商家后台登录

Route::post('/cart_del','Index\CartController@cart_del');//购物车删除
Route::post('/buy_jian','Index\CartController@buy_jian');//购物车减号
Route::post('/buy_jia','Index\CartController@buy_jia');//购物车加号
Route::post('/cart_zprice','Index\CartController@cart_zprice');//购物车总价格

});