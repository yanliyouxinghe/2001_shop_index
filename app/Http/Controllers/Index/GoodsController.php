<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    function goodsinfo($id){
  
        $url = 'http://2001.shop.api.com/goods/'.$id;
         $url = 'http://2001.shop.api.com/goods';
        // dd($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url );
        //参数为1表示传输数据，为0表示直接输出显示。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //参数为0表示不带头文件，为1表示带头文件
        curl_setopt($ch, CURLOPT_HEADER,0);
        $data = curl_exec($ch);
        // dd($goodsinfo);
        $data=json_decode($data,true);

        // $goodsinfo=json_decode($data['goodsinfo']);
        // dd($data['goodsinfo']);
        // dd($data);
        curl_close($ch);
        // exit()
        //规格属性
        
        return view('/goods/goodsinfo',['goodsinfo'=>$data['goodsinfo'],'attr'=>$data['attr']]);
    }
}
