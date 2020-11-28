<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
use Illuminate\Support\Facades\Redis;
class ListController extends Controller
{
    public function list($id){  
        /**获取商品的品牌和价格数据 */
        $query=request()->all();
        $query = $_SERVER['REDIRECT_QUERY_STRING']??'';
        $query = $query?'?'.$query:'';
        
        $url = 'http://2001.shop.api.com/getlist/'.$id.$query;
        // dd($url);

        /**登录 历史浏览记录 */
        Redis::hget('reg','user_id');
        $urlv = 'http://2001.shop.api.com/listhistory';
        $listhistory = geturl($urlv);


        $urls = request()->url();
        $getlist = geturl($url);
        // print_r($listhistory['listhistory']);die;
        //  dd($getlist);
        $brandInfo=$getlist['data']['brandInfo'];
        $priceInfo=$getlist['data']['priceInfo'];
        $goodsInfo=$getlist['data']['goodsInfo'];

        return view('list.list',['brandInfo'=>$brandInfo,'priceInfo'=>$priceInfo,'goodsInfo'=>$goodsInfo,'urls'=>$urls,'listhistory'=>$listhistory['listhistory']]);
    }





}
