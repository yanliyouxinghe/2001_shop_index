<?php

namespace App\Http\Controllers\Index;
use App\Common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
class IndexController extends Controller
{
    /** 前台首页 */
    public function index(){
 
        //轮播图展示
        $url = "http://2001.shop.api.com/slideshow";
        $slideshow = geturl($url);
    //    print_r($slideshow['data']);die;


         /**首页商品数据 */
         $url = "http://2001.shop.api.com/goodsInfo";
         $goodsInfo= geturl($url);
        //  print_r($goodsInfo);die;
        return view('index.index',['slideshow'=>$slideshow['data'],'goodsInfo'=>$goodsInfo['data']]);
       
    }





}
