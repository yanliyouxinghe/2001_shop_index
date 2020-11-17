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
        //首页菜单栏
        $data = CartgoryModel::get();
        // dd($data);
        $cartgoryInfo = infinite($data);
        //dd($cartgoryInfo);
        //轮播图展示
        $slideshow = GoodsModel::getslicedata();
        return view('index.index',['cartgoryInfo'=>$cartgoryInfo,'slideshow'=>$slideshow]);
    }



}
