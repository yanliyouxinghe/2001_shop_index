<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
class IndexController extends Controller
{
    /**登录获取token */
    public function login(){
        $post['admin_name'] = request()->admin_name;
        $post['admin_pwd'] = request()->admin_pwd;
        $url = "http://2001.shop.index.com/api/user/login";
        $token = $this->postcurl($url,$post);
        dd($token);
    }

    /**获取用户信息 */
    public function getuser(){
        //获取token
        $token = '';
        $url = '';
        $header = [];
        // $userinfo = 
    }

    public function getcurl(){

    }

    public function postcurl(){

    }

    /** 前台首页 */
    public function index(){
        //首页菜单栏
        $data = CartgoryModel::get();
        $cartgoryInfo = infinite($data);
        //轮播图展示
        $slideshow = GoodsModel::getslicedata();
        //dd($slideshow);
        //猜你喜欢
        $hitgoods = Redis::zrevrange('hit',0,5);
        //  dump($hitgoods);
         if(count($hitgoods)){
             $hit_goods_id = [];
             // dump($hit_goods_id);
             foreach($hitgoods as $v){
                 $hitsarr = explode('_',$v);
                 $hit_goods_id[] = $hitsarr[1];
             }
            //  dump($hit_goods_id);
             $hot_goods = GoodsModel::whereIn('goods_id',$hit_goods_id)->get();
            // dump($hot_goods);
         }
        return view('index.index',['cartgoryInfo'=>$cartgoryInfo,'slideshow'=>$slideshow,'hot_goods'=>$hot_goods]);
    }





}
