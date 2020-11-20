<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
class ListController extends Controller
{
    public function list($id){  
        /**获取商品的品牌和价格数据 */
        $query=request()->all();
        $query = $_SERVER['REDIRECT_QUERY_STRING']??'';
        $query = $query?'?'.$query:'';
        
        $url = 'http://2001.shop.api.com/getlist/'.$id.$query;
        // dd($url);

        $urls = request()->url();

        $getlist = geturl($url);
        //  dd($getlist);
        $brandInfo=$getlist['data']['brandInfo'];
        $priceInfo=$getlist['data']['priceInfo'];
        $goodsInfo=$getlist['data']['goodsInfo'];
  
        // dd($brandInfo);
       // dd($priceInfo);

        return view('list.list',['brandInfo'=>$brandInfo,'priceInfo'=>$priceInfo,'goodsInfo'=>$goodsInfo,'urls'=>$urls]);
    }
}
