<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    function goodsinfo(){
        // dd('123');
        //$url = 'http://localhost/testmysql.php';
        $url = 'http://2001.shop.api.com/goods';
        // dd($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url );
        //参数为1表示传输数据，为0表示直接输出显示。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //参数为0表示不带头文件，为1表示带头文件
        curl_setopt($ch, CURLOPT_HEADER,0);
        $goodsinfo = curl_exec($ch);
        $goodsinfo=json_decode($goodsinfo);
    //    dd($goodsinfo);
        curl_close($ch);
        // exit()
        return view('/goods/goodsinfo',['goodsinfo'=>$goodsinfo]);
    }
}
