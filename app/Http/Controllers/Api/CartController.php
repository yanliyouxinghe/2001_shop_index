<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
class CartController extends Controller
{   
    //加入购物车
    public function addcart(){
        $data=request()->getContent();
        
        $data=json_decode($data);
        // echo $data;die;
        dd($data);
        // $goods_id=$data['goods_id'];
        
        // $goods = GoodsModel::select('goods_id','goods_name','goods_price','is_show','goods_num')->find($data['goods_id']);
        // dd($goods);
       
       
        // $goods_id=request()->getContent('goods_id');
        //  dd($data);
    //   dd($goods_id);
    // return $data;
    }

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
