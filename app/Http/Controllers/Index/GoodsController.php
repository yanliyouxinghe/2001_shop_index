<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Shop_HistoryModel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;
use App\Model\CouponsModel;
class GoodsController extends Controller
{
    function goodsinfo($id){
        $url = 'http://2001.shop.api.com/goods/'.$id;
        $data = geturl($url);
        $goodsinfo=$data['goodsinfo'];
        $attr=$data['attr'];
        $recommended=$data['recommended'];
        $coupons=CouponsModel::where(['goods_id'=>$id])->get();
        // print_r($coupons);exit;
        //调用cookie添加历史浏览记录
        // $this->cookiehistory($goods_id);
        //print_r($res);die;
        $user_id = Redis::hget('reg','user_id');
        if(!$user_id){
            //不登录 添加历史浏览记录
            $this->cookiehistory($id);
        }else{
            //登录后 添加历史浏览记录
            $url = 'http://2001.shop.api.com/createhistory/'.$goods_id;
            geturl($url);
        }



        return view('/goods/goodsinfo',['goodsinfo'=>$goodsinfo,'attr'=>$attr,'recommended'=>$recommended,'coupons'=>$coupons]);
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


   /**cookie 添加历史浏览记录 不用入库*/
    public function cookiehistory($goods_id){
        //  Cookie::queue('historyInfo',$goods_id);
        $cookiehistory = $_COOKIE['historyInfo']??'';
        // print_r($cookiehistory);die;
       //判断cookie是否存在  从cookie中去值
        // $cookiehistory = Cookie::get('historyInfo');
        // var_dump($history);
            //  print_r($goods_ids);die;
                //如果商品已存在,将浏览时间更新为当前时间,并将信息从新加入cookie
    
        $cookiehistorys = unserialize($cookiehistory);
        //  print_r($cookiehistorys);exit; 

        if(!empty($cookiehistorys)){
            //从cookie中取出goods_id一列,判断当前商品是否存在
            $cookiehistorys [$goods_id] = ['goods_id'=>$goods_id,'add_time'=>time()];
            $cookiehistorys = serialize($cookiehistorys);
            setcookie('historyInfo',$cookiehistorys);

            // $goods_ids =array_column($cookiehistorys,'goods_id');
            //  print_r($goods_ids);die;
            // if(in_array($goods_id,$goods_ids)){
            //     //如果商品已存在,将浏览时间更新为当前时间,并将信息从新加入cookie
            //     $cookiehistorys['goods_id'] = $goods_id;
            //     $cookiehistorys['add_time'] = time(); 
            //     $cookiehistorys = serialize($cookiehistorys);
            //     setcookie('historyInfo',$cookiehistorys);
            //     return;
            // }else{
            //     //如果商品不存在cookie 则进行添加
            //     $cookiehistorys[$goods_id] = ['goods_id'=>$goods_id,'add_time'=>time()];
            //     $cookiehistorys = serialize($cookiehistorys);
            //     setcookie('historyInfo',$cookiehistorys);
            //     return;
            // }
        }else{
            //如果cookie不存在 存cookie
            $cookiehistorys [$goods_id] = ['goods_id'=>$goods_id,'add_time'=>time()];
            $cookiehistorys = serialize($cookiehistorys);
            setcookie('historyInfo',$cookiehistorys);
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
