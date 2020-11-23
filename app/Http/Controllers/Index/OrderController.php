<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
class OrderController extends Controller
{

    /**提交订单视图 */
    public function index(){
        //展示收货人信息
        $url = 'http://2001.shop.api.com/addressinfo';
        $addressinfo = geturl($url);
        // print_r($addressinfo['data']);die;
        // //展示提交订单商品信息
        // $url = 'http://2001.shop.api.com/cartgoodsinfo';
        // $cartgoodsinfo = geturl($url);
        // print_r($cartgoodsinfo);
        // die;
        
        return view('order.order',['addressinfo'=>$addressinfo['data']]);
    }

    /**收货地址ajax删除 */
    public function address_del(){
        $data['address_id'] = request()->address_id;
        $url = 'http://2001.shop.api.com/address_del';
        $address_del = posturl($url,$data);
        if($address_del['code']==0){
            return json_encode(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙']);
        }
    }
    

}
