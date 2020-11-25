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

use function AlibabaCloud\Client\redTable;

class OrderController extends Controller
{

    public function order(){
        return view('order.order_list');
    }

    /**提交订单视图 */
    public function index(){
        $user_id="1";
        $data['user_id']=$user_id;
        //展示收货人信息
        $url = 'http://2001.shop.api.com/addressinfo';
        $addressinfo = posturl($url,$data);
        //展示购物车商品数据
        //结算购物车
        $data['cart_id'] = request()->cart_id;
        if(!$data['cart_id']){
            return redirect('/cart');
        }
        $url = "http://2001.shop.api.com/account";
        $account = posturl($url,$data);
        return view('order.order',['addressinfo'=>$addressinfo['data'],'account'=>$account['data']]);
    }

    /**收货地址ajax删除 */
    public function address_del(){
        $data['address_id'] = request()->address_id;
        $user_id="1";
        $data['user_id']=$user_id;
        $url = 'http://2001.shop.api.com/address_del';
        $address_del = posturl($url,$data);
        if($address_del['data']['count_address'] ==1){
            return json_encode(['code'=>2,'msg'=>'Error']);
        }
        if($address_del['code']==0){
            return json_encode(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙']);
        }
    }


    //修改收货地址默认、
    public function mor(){
        $user_id="1";
        $data['user_id']=$user_id;
        $data['address_id'] = request()->input('address_id');
        $url = 'http://2001.shop.api.com/mor';
        $mor = posturl($url,$data);
        if($mor['code']==0){
            return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙']);
        }
    }
    
}
