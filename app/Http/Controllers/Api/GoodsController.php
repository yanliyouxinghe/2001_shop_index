<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
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
   
}
