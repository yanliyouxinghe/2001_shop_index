<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
use App\Model\NoticeModel;
class IndexController extends Controller
{
    /**首页分类数据 */
    public function cartgory(){
        $cartgoryInfo = CartgoryModel::get();
        $category = infinite($cartgoryInfo);
        return json_encode($category);
    }    

    /**首页商品表中轮播图数据 */
    public function slideshow(){
        $slideshow = GoodsModel::getslicedata();

        $reposer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=> $slideshow
        ];
        return json_encode($reposer);
    }

    /**首页商品数据数据 */
    public function goodsInfo(){

        $goodslove = GoodsModel::select('goods_name','goods_img','goods_id')->where('is_new','=',1)->limit(8)->get();
        $goodshot = GoodsModel::select('goods_name','goods_img','goods_id')->where('is_hot','=',1)->orderBy('goods_id','desc')->limit(10)->get();
        $goodsbest=GoodsModel::select('goods_name','goods_img','goods_id')->where('is_best','=',1)->orderBy('shop_price','ASC')->limit(5)->get();
        
        $reposer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>[
                'goodslove'=>$goodslove,
                'goodshot'=>$goodshot,
                'goodsbest'=>$goodsbest,
            ]
        ];

        return json_encode($reposer);
    }

    /**首页公告数据 */
    public function noticeinfo(){
        $noticeinfo = NoticeModel::limit(8)->get();
        $reposer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>$noticeinfo,
        ];
        return json_encode($reposer);
    }

    //搜索
    public function search(){

        $search_val = request()->input('search_val');
        if(!$search_val){
            $reposer = [
                'code'=>1,
                'msg'=>'Error',
                'data'=>[],
            ]; 
        }
        $where1 = [];
        if($search_val){
            $where1[] = ['goods_name','like',"%$search_val%"];
        }

        $search_data = GoodsModel::select('goods_id','goods_name','goods_img')->where($where1)->get();
        // print_r($search_data);die;
        if($search_data){
            $reposer = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>$search_data,
            ]; 
        }else{
            $reposer = [
                'code'=>2,
                'msg'=>'Error',
                'data'=>[],
            ]; 
        }
        // print_r($reposer);die;
      
        return json_encode($reposer);


    }

}