<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    function goodsinfo($id){
      
        // $id['id'] =  request()->input('id');
        $url = 'http://2001.shop.api.com/goods/'.$id;
        $data = geturl($url);
        $goodsinfo=$data['goodsinfo'];
        $attr=$data['attr'];
        $recommended=$data['recommended'];
        return view('/goods/goodsinfo',['goodsinfo'=>$goodsinfo,'attr'=>$attr,'recommended'=>$recommended]);
    }

   /**个人收藏 展示*/
   public function listcollect(){
        $user_id="1";
        // Redis::hget('reg','user_id')
        $data['user_id']=$user_id;
        $url = 'http://2001.shop.api.com/listcollect';
        $collectgoodsInfo = posturl($url,$data);
        // print_r($collectgoodsInfo);die;
       return view('goods.favorite',['collectgoodsInfo'=>$collectgoodsInfo['data']]);
   }

   /**ajax取消收藏 */
   public function cancel(){
        $user_id = "1";
        $data['user_id'] = $user_id;
        $data['goods_id'] = request()->goods_id;
        $url = 'http://2001.shop.api.com/cancel';
        $del_cencel = posturl($url,$data);
        if($del_cencel['code']==0){
            return json_encode(['code'=>0,'msg'=>'取消成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'取消失败']);
        } 
   }
   
}
