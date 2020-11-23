<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use App\Model\UseraddressModel;
use App\Model\CartModel;
use App\Model\RegionModel;

class OrderController extends Controller
{
    /**提交订单页面收件人信息数据 */
    public function addressinfo(){
        $token = '1';
        $addressinfo = UseraddressModel::where('user_id',$token)->get();
        // dd($addressinfo);
        //展示收货人信息成中文的
        if($addressinfo){
            foreach($addressinfo as $k=>$v){
                // dd($k);
                $addressinfo[$k]['country_name'] = RegionModel::where('region_id',$v['country'])->value('region_name');
                $addressinfo[$k]['province_name'] = RegionModel::where('region_id',$v['province'])->value('region_name');
                $addressinfo[$k]['city_name'] = RegionModel::where('region_id',$v['city'])->value('region_name');
                $addressinfo[$k]['district_name'] = RegionModel::where('region_id',$v['district'])->value('region_name');
            }  
        }
        // dd($addressinfo);

        $response = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>[
                'addressinfo'=>$addressinfo,
            ],
        ];
        // dd($response);
        return json_encode($response); 
        
    }

    /**api收货地址ajax删除 */
    public function address_del(){
        $token = '1';
        $address_id = request()->address_id;
        $address_del = UseraddressModel::where(['user_id'=>$token,'address_id'=>$address_id])->update(['is_del'=>2]);
        if($address_del){
            $response = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>$address_del,
            ]; 
        }else{
            $response = [
                'code'=>1,
                'msg'=>'删除失败',
                'data'=>[],
            ]; 
        }

        return json_encode($response);

    }


    /**提交订单页面商品信息数据 */
    public function cartgoodsinfo(){
        $cart_id = request()->cart_id;
        // print_r($cart_id);
        //要购买的商品信息 //获取当前用户的所有商品信息
        $cartgoodsInfo = CartModel::select('sh_cart.*','sh_goods.goods_img')->leftjoin('sh_goods','sh_cart.goods_id','=','goods_id.goods_id')->whereIn('cart_id',$cart_id)->get();
        // print_r($cartgoodsInfo);
        //计算规格
        //循环每一条商品数据
       // foreach($cartgoodsInfo as $k=>$v){
            // if(){
            //     //判断商品是否拥有属性
            //     //如果有属性 根据属性查询商品属性的名称与值
            // }
        //}
       
    }
}
