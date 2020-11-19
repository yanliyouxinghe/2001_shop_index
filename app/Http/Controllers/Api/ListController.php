<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
class ListController extends Controller
{
    /**获取Api列表页数据 */
    public function getlist($id){
        //判断此分类下有无子分类
        $cat_id = CartgoryModel::where('parent_id',$id)->pluck('cat_id');
        $cat_id=$cat_id?$cat_id->toArray():[];    //没有子分类给个空
        array_push($cat_id,$id);
        $goodsInfo= GoodsModel::whereIn('cat_id',$cat_id)->get();          //获取商品数据
        $goods =  $goodsInfo? $goodsInfo->toArray():[];
    //    dd($brand_name);
        $goods_brand = array_column($goods,'brand_id');
        $brand_id = array_unique($goods_brand);
        // dd($brand_id);

        //去商品表 获取列表品牌
        // $brandInfo = BrandModel::where('brand_id',$brand_id)->


        $brandInfo = GoodsModel::select("brand_name","sh_brand.brand_id")->leftjoin("sh_brand",'sh_goods.brand_id','=','sh_brand.brand_id')->whereIn('sh_brand.brand_id',$brand_id)->get()->toArray();
        $val=[];
        foreach($brandInfo as $k=>$v){
            $val[$v['brand_id']]=$v;
        }
        // dd($brandInfo);

        
         //dd($brandInfo);
        //获取列表价格数据
        $priceInfo = GoodsModel::where('cat_id',$id)->max('shop_price');
        $priceInfo = $this->getprice($priceInfo);
         $response = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>[
                'brandInfo'=>$val,
                'priceInfo'=>$priceInfo,
                'goodsInfo'=>$goodsInfo,
            ],
        ];
    
        return json_encode($response);
    }

    /**将价格等分成若干份 */
    public function getprice($max_price){
        //dd($max_price);
         //将价格等分成5份
         $length = strlen($max_price);
         $max_count = substr($max_price,0,1);
         $max_price = '1'.str_repeat(0,$length-1);     //字符串重复
        //  dump($max_price);
         $max_price = $max_price*$max_count;
         //dd($max_price);
         $shop_price = $max_price/5;
         for($i=0;$i<5;$i++){
            $min_price = $shop_price*$i;
            $max_price = $shop_price*($i+1);
            $totalprice[] = $min_price.'-'.$max_price.'元';
         }
         $totalprice[] = $max_price.'元以上';
         return $totalprice;
    }

     //$query = request()->all();
    // $where=[];
        // //按价格搜索
        // if(isset($query['shop_price'])){
        //     $shop_price=explode('元',$query['shop_price']);
        //     $shop_price=explode('-',$shop_price[0]);
        //     //dd($shop_price);
        //     $where[]=[
        //         'shop_price','>',$shop_price[0]
        //     ];
        // if(isset($shop_price[1])){
        //     $where[]=[
        //         'shop_price','<',$shop_price[1]
        //         ];
        //     }
        // }
        // //按品牌搜索
        // if(isset($query['brand_name'])){
        //     $where[]=[
        //         'brand_name','=',$query['brand_name']
        //     ];
        // }

}
