<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**提交订单视图 */
    public function index(){
        //展示收货人信息
        $url = 'http://2001.shop.index.com/addressinfo';
        $addressinfo = geturl($url);
        //展示提交订单商品信息
        $url = 'http://2001.shop.index.com/cartgoodsinfo';
        $cartgoodsinfo = geturl($url);
        
        return view('order.order');
    }
    
}
