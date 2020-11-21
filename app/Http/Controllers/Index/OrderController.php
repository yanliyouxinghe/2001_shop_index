<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
<<<<<<< HEAD
    public function order(){
        return view('order.order_list');
    }
=======
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
    
>>>>>>> a0d40c5974ad4af0275e8ef7cc2bf899606b0add
}
