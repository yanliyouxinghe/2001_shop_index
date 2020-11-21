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



Route::any('/goods/{goods_id}','Index\GoodsController@goodsinfo');//详情
Route::get('/login','Index\LoginController@login');//登录

Route::any('/goodsinfo','Index\GoodsController@goodsinfo');//详情
Route::get('/reg','Index\LoginController@reg');//注册
Route::get('/ser','Index\UserController@ser');//个人中心
Route::get('/address','Index\UserController@address');//收货地址
Route::get('/cart','Index\CartController@cart');//头部购物车或购物车列表
Route::get('/favo','Index\FavoController@favo');//收藏
Route::post('/logdo','Index\LoginController@logindo');//登录
Route::get('/order','Index\OrderController@order');//订单
Route::get('/profile','Index\ProfileController@profile');//个人资料
Route::get('/changepass','Index\ProfileController@changepass');//修改密码



Route::get('/reg','Admin\BusinessController@reg');//商家后太注册
Route::get('/business','Admin\BusinessController@business');//商家后台登录
});