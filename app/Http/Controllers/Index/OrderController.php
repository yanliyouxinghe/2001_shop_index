<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
use App\Model\Order_GoodsModel;
use App\Model\Order_InfoModel;
class OrderController extends Controller
{

    public function order(){
        return view('order.order_list');
    }

    /**提交订单视图 */
    public function index(){
        $token="1";
        $data['token']=$token;
        //展示收货人信息
        $url = 'http://2001.shop.api.com/addressinfo';
        $addressinfo = posturl($url,$data);
        //展示购物车商品数据
        // print_r($addressinfo);die;
         
        return view('order.order',['addressinfo'=>$addressinfo['data']]);
    }

    /**收货地址ajax删除 */
    public function address_del(){
        $data['address_id'] = request()->address_id;
        $token="1";
        $data['token']=$token;
        $url = 'http://2001.shop.api.com/address_del';
        $address_del = posturl($url,$data);
        if($address_del['code']==0){
            return json_encode(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙']);
        }
    }
    
}
