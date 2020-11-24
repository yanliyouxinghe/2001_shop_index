<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    function goodsinfo($id){
      
        // $id['id'] =  request()->input('id');
        $url = 'http://2001.shop.api.com/goods/'.$id;
        //dd($url);
        $data = geturl($url);
        // dd($data);
        // $object = (object)$arrayName;
        $goodsinfo=$data['goodsinfo'];
        // $goodsinfo=(object)$goodsinfo;
        // dd($goodsinfo);
        $attr=$data['attr'];
        // dd($attr);
        // $attr=(object)$attr;
        return view('/goods/goodsinfo',['goodsinfo'=>$goodsinfo,'attr'=>$attr]);
    }
}
