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

    //搜索
    public function search(){
        $search_val = request()->input('search_val');
        if(!$search_val){
            if($_SERVER['HTTP_REFERER'] == "http://2001.shop.index.com/search"){
                return view('index.search_list',['search_data'=>[]]);
            }else{
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $search_type = request()->input('search_type');

        if($search_type == 1){
            $data['search_val'] = $search_val;
            $url = "http://2001.shop.api.com/search";
            $search_data = posturl($url,$data);
            $data = $search_data['data'];
            return view('index.search_list',['search_data'=>$data]);
        }else{
            echo "2";die;
        }
    }



    //冒泡排序
    public function maopao(){
       $arr = [3,69,9,100,32,67];
        if(!is_array($arr)){
            return;
        }
        if(count($arr) < 2){
            return;
        }
        $len = count($arr);
        for($i=0;$i<$len-1;$i++){
            for($j=$i+1;$j<$len;$j++){
                if($arr[$i] > $arr[$j]){
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
        print_r($arr);die;
    }


    




}
