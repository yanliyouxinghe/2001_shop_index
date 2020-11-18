<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
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
                'mag'=>'您的购物车中没有商品',
                'data'=>[],
            ];
        }else{
            $respoer = [
                'code'=>0,
                'mag'=>'OK',
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
            'mag'=>'OK',
            'data'=>$cart_count,
        ];
    	return json_encode($respoer);
    }
}
