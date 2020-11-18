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

<<<<<<< HEAD
=======
Route::middleware(['header'])->group(function () {
>>>>>>> c2d097f56e411e64a23a02ff9bd092bc43139808


<<<<<<< HEAD
Route::get('/','Index\IndexController@index');  //前台首页
<<<<<<< HEAD


Route::any('/goods/{goods_id}','Index\GoodsController@goodsinfo');//详情
Route::get('/login','Index\LoginController@login');//登录
=======
=======

Route::get('/','Index\IndexController@index');  //前台首页

>>>>>>> 1ca118c4ff1552266e33b04ae55593ce241a5a7b
Route::any('/goodsinfo','Index\GoodsController@goodsinfo');//详情
>>>>>>> c2d097f56e411e64a23a02ff9bd092bc43139808
Route::get('/reg','Index\LoginController@reg');//注册
Route::get('/ser','Index\UserController@ser');//个人中心
Route::get('/cart','Index\CartController@cart');//头部购物车或购物车列表
Route::get('/favo','Index\FavoController@favo');//收藏
Route::post('/logdo','Index\LoginController@logindo');//登录
});