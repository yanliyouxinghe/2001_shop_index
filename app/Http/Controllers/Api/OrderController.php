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

class OrderController extends Controller
{
    /**提交订单页面收件人信息数据 */
    public function addressinfo(){
      $token=request()->input('token');
      $addressinfo = UseraddressModel::where('user_id',$token)->get();
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
        $token=request()->input('token');
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
        
    }

    /**执行提交订单 */
    public function orderdo(){
        
    }



}
