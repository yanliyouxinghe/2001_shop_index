<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use App\Model\Shop_HistoryModel;
use App\Model\CollectModel;
class GoodsController extends Controller
{
    
    public function goods($id){
          
        //商品基本信息
       $goodsinfo=GoodsModel::leftjoin('sh_brand','sh_goods.brand_id','=','sh_brand.brand_id')->where('sh_goods.goods_id',$id)->get();
       foreach($goodsinfo as $v){
        $cat_id=$v['cat_id'];
       }
      
       $recommended=GoodsModel::where(['cat_id'=>$cat_id])->get();
       //dd($goodsinfo);
    //商品规格
        $attr = Goods_AttrModel::select('goods_attr_id','sh_goods_attr.attr_id','sh_attribute.attr_name','sh_goods_attr.attr_value')
        ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
        ->where(['goods_id'=>$id,'sh_attribute.attr_type'=>1])
        ->get();
        $new_attr=[];
        if($attr){
            foreach($attr as $k => $v){
                $new_attr[$v['attr_id']]['attr_name'] = $v['attr_name'];
                $new_attr[$v['attr_id']]['attr_value'][$v['goods_attr_id']] = $v['attr_value'];
            }
           $data1=['goodsinfo'=>$goodsinfo,'attr'=>$new_attr,'recommended'=>$recommended];
  
           return json_encode($data1);
        }else{
            $data2=['goodsinfo'=>$goodsinfo,'attr'=>$attr,'recommended'=>$recommended];
    
            return json_encode($data2);
        }
        
    }

    /**API个人收藏  添加*/
    public function createcollect(){
        
        $goods_id = request()->goods_id;
        $user_id="1";
        if(!$user_id){
            return json_encode(['code'=>'1001','msg'=>'请先登录']);
        }
        $count = CollectModel::where(['user_id'=>$user_id,'goods_id'=>$goods_id])->first();
        // print_r($count);
        //判断此用户是否收藏过此此商品
        // if($count==1){
        //     return json_encode(['code'=>'1002','msg'=>'您已收藏过']);
        // }else{
        //     $collect = CollectModel::insert($count);
        //     if($collect){
        //         return json_encode(['code'=>'1003','msg'=>'收藏成功']);
        //     }
        // }
    }

    /**API个人收藏 展示 */
    public function listcollect(){
        $collectInfo = CollectModel::leftjoin('sh_goods','sh_collect.goods_id','=','sh_goods.goods_id')->get();
        $response = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>[
                'collectInfo'=>$collectInfo
            ],
        ];
        return json_encode($response);
    }
   
}
