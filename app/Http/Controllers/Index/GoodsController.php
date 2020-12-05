<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Shop_HistoryModel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    function goodsinfo($id){
        $url = 'http://2001.shop.api.com/goods/'.$id;
        $data = geturl($url);
        $goodsinfo=$data['goodsinfo'];
        $attr=$data['attr'];
        $recommended=$data['recommended'];

        //历史浏览记录
        $this->history($id);
        return view('/goods/goodsinfo',['goodsinfo'=>$goodsinfo,'attr'=>$attr,'recommended'=>$recommended]);
    }

   /**个人收藏 展示*/
   public function listcollect(){
        $user_id=Redis::hget('reg','user_id');
        if(!$user_id){
            return redirect('/login');
        }
        $data['user_id']=$user_id;
        $url = 'http://2001.shop.api.com/listcollect';
        $collectgoodsInfo = posturl($url,$data);
       return view('goods.favorite',['collectgoodsInfo'=>$collectgoodsInfo['data']]);
   }



   /**ajax取消收藏 */
   public function cancel(){
        $user_id = Redis::hget('reg','user_id');
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

   /**历史浏览记录 */
   public function history($goods_id){
      $user_id = Redis::hget('reg','user_id');
      if(!$user_id){
          //不登录历史浏览记录
        //   $this->cookiehistory($id);
      }else{
          //登录后 
          $url = 'http://2001.shop.api.com/createhistory/'.$goods_id;
          geturl($url);
      }


   }

   /**cookie 添加历史浏览记录 */
    public function cookiehistory($id){
     //判断cookie是否存在  从cookie中去值
     $cookiehistory = Cookie::get('historyInfo');
     $cookiehistory = unserialize($cookiehistory);
     if(!empty($cookiehistory)){
         //从cookie中取出goods_id一列,判断当前商品是否存在
         $goods_ids =array_column($cookiehistory,'goods_id');
         if(in_array($id,$goods_ids)){
             //如果商品已存在,将浏览时间更新为当前时间,并将信息从新加入cookie
             $cookiehistory[$id]['add_time'] = time();
             $cookiehistory = serialize($cookiehistory);
             Cookie::queue('historyInfo','$cookiehistory');
             return;
         }else{
             //如果商品不存在cookie 则进行添加
             $cookiehistory[$id] = ['goods_id'=>$id,'add_time'=>time()];
             $cookiehistorys = unserialize($cookiehistory);
             Cookie::queue('historyInfo','$cookiehistorys');
             return;
         }
     }else{
         //如果cookie不存在 存cookie
         $cookiehistory[$id] = ['goods_id'=>$id,'add_time'=>time()];
         $cookiehistory = serialize($cookiehistory);
         Cookie::queue('historyInfo','$cookiehistory');
        }
    }

    /**cookie历史浏览记录展示 */
    public function cookielist(){
        $cookiehistory = Cookie::get('historyInfo');
        $cookiehistory = unserialize($cookiehistory);
        if($cookiehistory){
            $goods_ids = array_column($cookiehistory,'goods_id');
            $goods = GoodsModel::whereIn('goods_id','$goods_ids')->take(5)->get();
            return json_encode(['code'=>'01','data'=>'$goods']);
        }else{
            return json_encode(['code'=>'02','msg'=>'还没有浏览商品']);
        }
    }

 //领取优惠券
    function coupons($id){
        $data['goods_id'] = $id;
        //  print_r($data);die;
        $url = "http://2001.shop.api.com/coupons";
        // print_r($url);die;
        $data=posturl($url,$data);
        // print_r($data);die;
        return view('goods.coupons',['data'=>$data]);
    }

   
}
