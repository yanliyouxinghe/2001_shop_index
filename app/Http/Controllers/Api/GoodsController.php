<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
class GoodsController extends Controller
{
    public function goods(){
        $goodsinfo = \DB::table('sh_goods')
            ->where('goods_id',1)
            ->join('sh_brand','sh_goods.brand.id','=','sh_brand.brand_id')
            ->select('sh_goods.*','sh_brand.*')
            ->select();
       //$goodsinfo=GoodsModel::where('goods_id',1)->get();
        return $goodsinfo;
    }
}
