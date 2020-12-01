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
Route::post('/orderdo','Index\OrderController@orderdo');  //执行提交订单
Route::get('/createcollect','Index\GoodsController@createcollect');    //个人收藏添加
Route::get('/favorite','Index\GoodsController@listcollect');    //个人收藏展示
Route::post('/cancel','Index\GoodsController@cancel');    //取消个人收藏
Route::get('/noticeinfo','Index\IndexController@noticeinfo');    //前台首页公告
Route::view('/notice_list','index/notice_list');    //前台首页公告展示页
Route::view('/notice_read','index/notice_read');    //前台首页公告详情页

Route::get('/noticeinfo','Index\IndexController@noticeinfo');    //前台首页公告


Route::post('/listhistory','Index\ListController@listhistory');    //登录后历史浏览记录展示

Route::get('/pay/{order_id}','Index\PayController@pay');  //支付
Route::get('/return_url','Index\PayController@return_url');    //支付宝同步跳转
Route::post('/notify_url','Index\PayController@notify_url');  //支付宝异步跳转




Route::get('/goods/{goods_id}','Index\GoodsController@goodsinfo');//详情
Route::get('/getattrprice','Index\CartController@getattrprice');
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
Route::post('/mor','Index\OrderController@mor');//修改默认收货地址


Route::get('/sereg','Admin\BusinessController@sereg');//商家后太注册
Route::get('/business','Admin\BusinessController@business');//商家后台登录
Route::post('/selog','Admin\BusinessController@selogin');//商家执行登录
Route::get('/index','Admin\SellController@index');//商家后台首页
Route::get('/goods','Admin\GoodsController@goods');//商家后台商品添加
Route::any('/upload','Admin\GoodsController@upload');//图片上传接口
Route::any('/uploads','Admin\GoodsController@uploads');//图片上传接口
Route::get('/goodslist','Admin\GoodsController@goodslist');//商家后台商品列表
Route::get('/getattr','Admin\GoodsController@getattr')->name('gooods.getattr');//商品属性

Route::post('/cart_del','Index\CartController@cart_del');//购物车删除
Route::post('/buy_jian','Index\CartController@buy_jian');//购物车减号
Route::post('/buy_jia','Index\CartController@buy_jia');//购物车加号
Route::post('/cart_zprice','Index\CartController@cart_zprice');//购物车总价格
Route::get('/addorder','Index\OrderController@index');//购物车点击结算

Route::get('seckill/index','Index\SeckillController@index');//秒杀列表页
Route::post('seckill/seckilldo','Index\SeckillController@seckilldo');//秒杀列表页
Route::get('/logout','Index\LoginController@logout');//购物车点击结算
Route::post('/orderinfo','Index\OrderController@orderinfo');  //收货地址ajax删除
Route::post('/orderinfo','Index\OrderController@orderinfo');  //生成订单


Route::get('/userorderlist','Index\UserController@userorderlist');  //生成订单
Route::post('/changepwd','Index\UserController@changepwd');  //修改密码
Route::get('/logistics/{id}','Index\LogisticsController@logistics');  //查看物流





Route::get('/coupons/{goods_id}','Index\GoodsController@coupons');//优惠券


});