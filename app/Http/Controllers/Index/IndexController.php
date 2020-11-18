<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
class IndexController extends Controller
{
    /** 前台首页 */
    public function index(){
<<<<<<< HEAD
        //首页菜单栏
        $url = "http://2001.shop.api.com/cartgory";
        $cartgoryInfo = geturl($url);
        //轮播图展示
        $url = "http://2001.shop.api.com/slideshow";
        $slideshow = geturl($url);

         /**首页商品数据 */
         $url = "http://2001.shop.api.com/goodsInfo";
         $goodsInfo= geturl($url);
        return view('index.index',['cartgoryInfo'=>$cartgoryInfo,'slideshow'=>$slideshow,'goodsInfo'=>$goodsInfo['data']]);
=======
       
        //轮播图展示
        $slideshow = GoodsModel::getslicedata();
        //dd($slideshow);
        return view('index.index',['slideshow'=>$slideshow]);
>>>>>>> 1ca118c4ff1552266e33b04ae55593ce241a5a7b
    }





}
