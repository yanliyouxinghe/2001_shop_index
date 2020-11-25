<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    function goodsinfo($id){
      
        // $id['id'] =  request()->input('id');
        $url = 'http://2001.shop.api.com/goods/'.$id;
        $data = geturl($url);
        $goodsinfo=$data['goodsinfo'];
        $attr=$data['attr'];
        $recommended=$data['recommended'];
        return view('/goods/goodsinfo',['goodsinfo'=>$goodsinfo,'attr'=>$attr,'recommended'=>$recommended]);
    }

   
}
