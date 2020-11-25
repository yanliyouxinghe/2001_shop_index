<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
use App\Model\Goods_AttrModel;
use App\Model\GoodsAttrModel;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{   
    //购物车列表数据
    public function cartdata(){
        $user_id = request()->input('user_id');

        $cart_data = CartModel::select('sh_cart.*','sh_goods.goods_img')
                    ->leftjoin('sh_goods','sh_cart.goods_id','=','sh_goods.goods_id')
                    ->where('user_id',$user_id)
                    ->get();

        foreach ($cart_data as $key=>$val){
            $attr_name =[];
            $val->goods_attr_id = trim($val->goods_attr_id,'');

            if($val->goods_attr_id && $val->goods_attr_id!==''){
                $goods_attr_id = explode("|",$val->goods_attr_id);
                if(count($goods_attr_id)){
                    foreach($goods_attr_id as $k=>$v){
                        $attr_Data=Goods_AttrModel::select('sh_goods_attr.attr_value','sh_attribute.attr_name')
                            ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
                            ->where(['goods_attr_id'=>$v])
                            ->get();
                        $attr_name[]= $attr_Data[0]['attr_name'].":".$attr_Data[0]['attr_value'];               
                    }
                    $val['attr_nane']=$attr_name;
                }
            }

        }
        if(!count($cart_data)){
            $respoer = [
                'code'=>1,
                'msg'=>'您的购物车中没有商品',
                'data'=>[],
            ];
        }else{
            $respoer = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>$cart_data 
            ];
        }
    	return json_encode($respoer);
    }

    //购物车商品数量
    public function cart_count(){
        $user_id = request()->input('user_id');
        $cart_count = CartModel::where('user_id',$user_id)->count();
        $respoer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>$cart_count,
        ];
    	return json_encode($respoer);
    }

    //购物车删除
    public function cart_del(){
        $user_id = request()->input('user_id');
        $cart_id = request()->input('cart_id');
        
        $del = CartModel::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->delete();
        if($del){
            $respoer = [
                'code'=>'0',
                'msg'=>'OK',
                'data'=>$del,
            ];
        }else{
            $respoer = [
                'code'=>'1',
                'msg'=>'失败',
                'data'=>[],
            ];
        }
       
    	return json_encode($respoer);
    }

    //减号
    public function buy_jian(){
        $user_id = request()->input('user_id');

        $cart_id = request()->input('cart_id');
        $buy = CartModel::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->value('buy_number');
        if($buy > 1){
            $buy2 = CartModel::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->decrement('buy_number');  
            $price = DB::select("SELECT (buy_number*shop_price) as price FROM `sh_cart` where cart_id=$cart_id");
            $respoer = [
                'code'=>'0',
                'msg'=>'OK',
                'data'=>$price 
            ];   
        }else{
            $respoer = [
                'code'=>'1',
                'msg'=>'不能再少了'
            ];
        }
    	return json_encode($respoer);
    }

    //加号
    public function buy_jia(){
        $user_id = request()->input('user_id');

        $cart_id = request()->input('cart_id');

        $buy = CartModel::select('sh_cart.buy_number','sh_goods.goods_number')
                ->leftjoin('sh_goods','sh_cart.goods_id','=','sh_goods.goods_id')
                ->where(['user_id'=>$user_id,'cart_id'=>$cart_id])
                ->first();
        if(!$buy['buy_number'] || !$buy['goods_number']){
            $respoer = [
                'code'=>'4',
                'msg'=>'该商品不存在'
            ];   
            return json_encode($respoer);die;
        }

        if($buy['buy_number'] < $buy['goods_number']){
            $buy3 = CartModel::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->increment('buy_number');  
            if($buy3){
                $price = DB::select("SELECT (buy_number*shop_price) as price FROM `sh_cart` where cart_id=$cart_id");
                $respoer = [
                    'code'=>'0',
                    'msg'=>'OK',
                    'data'=>$price 
                ];   
                return json_encode($respoer);die;
            }else{
                $respoer = [
                    'code'=>'3',
                    'msg'=>'操作繁忙...'
                ];
                return json_encode($respoer);die;
            }
        }else{
            $respoer = [
                'code'=>'2',
                'msg'=>'亲，存库不足了！'
            ];
            return json_encode($respoer);die;
        }
    }


        //购物车总价格
        public function cart_zprice(){
            $user_id = request()->input('user_id');

            $cart_ids = request()->all()?:request()->getContent();
            $cart_ids = implode(',',$cart_ids);
             $total = DB::select("select sum(buy_number*shop_price) as total from sh_cart where cart_id in ($cart_ids)");
            $respoer = [
                'code'=>'0',
                'msg'=>'OK',
                'data'=>$total
            ];   
            return json_encode($respoer);


        }

        
        public function is_not_json($str){
            return is_null(json_decode($str));
        }



   
}
