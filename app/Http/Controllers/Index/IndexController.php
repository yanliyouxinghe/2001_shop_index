<?php

namespace App\Http\Controllers\Index;
use App\Common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
use App\Model\NoticeModel;
class IndexController extends Controller
{
    /** 前台首页 */
    public function index(){
        //轮播图展示
        $url = "http://2001.shop.api.com/slideshow";
        $slideshow = geturl($url);

         //首页商品数据
         $url = "http://2001.shop.api.com/goodsInfo";
         $goodsInfo= geturl($url);
         $user_id=Redis::hmget('reg','user_id','user_plone');

        //首页公告数据
        // $user_id="1";
        // $data['user_id']=$user_id;
        $url = "http://2001.shop.api.com/noticeinfo";
        $noticeinfo = geturl($url);

        return view('index.index',['slideshow'=>$slideshow['data'],'goodsInfo'=>$goodsInfo['data'],'user_id'=>$user_id,'noticeinfo'=>$noticeinfo['data']]);
       
    }





}
