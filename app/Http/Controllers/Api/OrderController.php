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
use App\Model\Order_GoodsModel;
use App\Model\Order_InfoModel;
use DB;

class OrderController extends Controller
{
    /**提交订单页面收件人信息数据 */
    public function addressinfo(){
      $user_id=request()->input('user_id');
      $addressinfo = UseraddressModel::where(['user_id'=>$user_id,'is_del'=>1])->get();
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
        $response = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>[
                'addressinfo'=>$addressinfo,
            ],
        ];
        return json_encode($response); 
        
    }

    /**api收货地址ajax删除 */
    public function address_del(){
        $user_id=request()->input('user_id');
        $address_id = request()->address_id;
        $count_address = UseraddressModel::where(['user_id'=>$user_id,'is_del'=>1])->count();
        $address_del = UseraddressModel::where(['user_id'=>$user_id,'address_id'=>$address_id])->update(['is_del'=>2]);
        if($address_del){
            $response = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>[
                    'address_del'=>$address_del,
                    'count_address'=>$count_address,
                ],
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
        public function account(){
        $cart_ids = request()->input('cart_id');
        $price = DB::select("select SUM(shop_price*buy_number) as total FROM sh_cart where cart_id in ($cart_ids)");
        $cart_ids = explode(',',$cart_ids);

        $cart_data = CartModel::select('sh_cart.*','sh_goods.goods_img')
            ->leftjoin('sh_goods','sh_cart.goods_id','=','sh_goods.goods_id')
            ->whereIn('cart_id',$cart_ids)
            ->get();
            foreach($cart_data as $k=>$v){
                // print_r($v);die;
                $attr = [];
                if(isset($v->goods_attr_id) && $v->goods_attr_id!=''){
                    $goods_attr_id = explode('|',$v->goods_attr_id);
                    foreach($goods_attr_id as $kk=>$vv){
                        $attr_data = Goods_AttrModel::select('sh_goods_attr.attr_value','sh_attribute.attr_name')
                                ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
                                ->where('goods_attr_id',$vv)
                                ->get();
                        $attr[] = $attr_data[0]['attr_name'].":".$attr_data[0]['attr_value'];
                    }
                    $v['attr'] = $attr;
                }
            } 
                $respoer = [
                    'code'=>0,
                    'msg'=>'OK',
                    'data'=>[
                        'cart_data'=>$cart_data,
                        'end_price'=>$price,
                    ],
                ];
            
        return json_encode($respoer);
        }

    /**执行提交订单 */
    public function orderdo(){
        
    }


    //修改默认收货地址
    public function mor(){
        $address_id = request()->input('address_id');
        $user_id = request()->input('user_id');
        
        $default = UseraddressModel::where(['user_id'=>$user_id])->update(['is_default'=>0]);
        if($default){
           $is_default =  UseraddressModel::where(['address_id'=>$address_id])->update(['is_default'=>1]);
            if($is_default){
                $respoer = [
                    'code'=>0,
                    'msg'=>'OK',
                    'data'=>$is_default
                ];  
            }
        }else{
            $respoer = [
                'code'=>1,
                'msg'=>'Error',
                'data'=>[]
            ]; 
        }
        return json_encode($respoer);

    }



}
