<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{   

    //购物车列表数据
    public function cartdata(){
        $token = '2';
        $cart_data = CartModel::select('sh_cart.*','sh_goods.goods_thumb')
                    ->leftjoin('sh_goods','sh_cart.goods_id','=','sh_goods.goods_id')
                    ->where('user_id',$token)
                    ->get();
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
        $token = '2';
        $cart_count = CartModel::where('user_id',$token)->count();
        $respoer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>$cart_count,
        ];
    	return json_encode($respoer);
    }

    public function cart_del(){
        $token = '2';
        $cart_id = request()->input('cart_id');
        
        $del = CartModel::where(['user_id'=>$token,'cart_id'=>$cart_id])->delete();
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

    public function buy_jian(){
        $token = '2';
        $cart_id = request()->input('cart_id');
        $buy = CartModel::where(['user_id'=>$token,'cart_id'=>$cart_id])->value('buy_number');
        if($buy > 1){
            $buy2 = CartModel::where(['user_id'=>$token,'cart_id'=>$cart_id])->decrement('buy_number');  
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


    public function buy_jia(){
        $token = '2';
        $cart_id = request()->input('cart_id');

        $buy = CartModel::select('sh_cart.buy_number','sh_goods.goods_number')
                ->leftjoin('sh_goods','sh_cart.goods_id','=','sh_goods.goods_id')
                ->where(['user_id'=>$token,'cart_id'=>$cart_id])
                ->first();
        if(!$buy['buy_number'] || !$buy['goods_number']){
            $respoer = [
                'code'=>'4',
                'msg'=>'该商品不存在'
            ];   
            return json_encode($respoer);die;
        }

        if($buy['buy_number'] < $buy['goods_number']){
            $buy3 = CartModel::where(['user_id'=>$token,'cart_id'=>$cart_id])->increment('buy_number');  
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

   
}
