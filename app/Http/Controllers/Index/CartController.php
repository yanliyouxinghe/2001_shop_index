<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function cart(){

        $cart = $this->getdata();
        // dd($cart);
       return view('cart.cart',compact('cart'));
    }



    //购物车数据
    public function getdata(){
    $url = "http://2001.shop.api.com/cart";
    $data_json = geturl($url);
    return $data_json;
    }

    //购物车删除
    public function cart_del(){
        $data['cart_id'] = request()->cart_id;

        $url = "http://2001.shop.api.com/cart_del";
        $del_cart = posturl($url,$data);
       // dd($del_cart);
        // dd($del_cart['code']);
        if($del_cart['code'] == 0){
             return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙。。。']);
        }
    }


    //减号
    public function buy_jian(){
        $data['cart_id'] = request()->cart_id; 
        
        $url = "http://2001.shop.api.com/buy_jian";
        
        $buy_jian = posturl($url,$data);
        if($buy_jian['code'] == 0){
            return json_encode(['code'=>0,'msg'=>'OK','price'=>$buy_jian['data'][0]]);
        }else{
            return json_encode(['code'=>1,'msg'=>'不能再少了']);
        }
    }
    
    public function buy_jia(){
        $data['cart_id'] = request()->cart_id;
        
        $url = "http://2001.shop.api.com/buy_jia";
        
        $buy_jia = posturl($url,$data);
        if($buy_jia['code'] == 0){
            return json_encode(['code'=>0,'msg'=>'OK','price'=>$buy_jia['data'][0]]);
        }else{
            return json_encode(['code'=>1,'msg'=>$buy_jia['msg']]);
        }
    }
   


}
