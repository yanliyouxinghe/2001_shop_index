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
    Route::get('/','Api\IndexController@index');   //前台首页

    // Route::any('goods','Api\GoodsController@goods');//详情
    Route::any('getuserinfo','Api\LoginController@getuserinfo');//
    Route::any('/','Api\IndexController@index');   //前台首页

    Route::get('goods/{goods_id}','Api\GoodsController@goods');//详情
    Route::post('addcart','Api\CartController@addcart');//加入购物车
    Route::any('cartgory','Api\IndexController@cartgory'); //首页菜单栏分类数据
    Route::any('slideshow','Api\IndexController@slideshow'); //首页商品表轮播图数据
    Route::get('goodsInfo','Api\IndexController@goodsInfo'); //首页商品表数据
    Route::get('getlist/{id}','Api\ListController@getlist'); //列表页品牌数据
    Route::get('addressinfo','Api\OrderController@addressinfo');    //提交订单页面收件人信息数据
    Route::get('cartgoodsinfo','Api\OrderController@cartgoodsinfo');    //提交订单页面商品数据
    Route::post('address_del','Api\OrderController@address_del');    //提交订单页面收货地址ajax删除

    Route::post('logindo','Api\LoginController@logindo');//执行登录
    Route::get('cart_count','Api\CartController@cart_count'); //购物车数据条数
    Route::get('getsondata','Api\UserController@getsondata'); //三级联动
    Route::get('store','Api\UserController@store'); //添加地址   地址列表


    Route::get('cart','Api\CartController@cartdata'); //购物车列表数据
    Route::post('cart_del','Api\CartController@cart_del'); //购物车删除
    Route::post('buy_jian','Api\CartController@buy_jian'); //减少购买数量
    Route::post('buy_jia','Api\CartController@buy_jia'); //加购买数量
    Route::post('cart_zprice','Api\CartController@cart_zprice'); //总价格

    
});

  

