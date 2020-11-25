<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }
    public function reg(){
        return view('login.reg');
    }

    public function logindo(Request $request){
       $data['user_plone'] = $request->user_plone;
       $data['user_pwd'] = $request->user_pwd;
//  dd($data);
       $url = "http://2001.shop.api.com/logindo";
       $res=$this->posturl($url,$data);
    //    dd($res);
        if($res['code']=='00000'){
             Redis::Hmset('reg','token',$res['token'],'user_id',$res['user']["user_id"],'user_plone',$res['user']["user_plone"]);

            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }


    public function posturl($url,$data){

            $headerArray = [];
           // $headerArray =["Content-type:application/json;charset='utf-8'","Accept:application/json"];
            $curl = curl_init();//初始化
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
            curl_setopt($curl, CURLOPT_POST, true);//设置post提交
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//post提交表单数据
            curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
           
            // print_r($output);die;
            // print_r(curl_errno($curl));die;
            // echo $output;exit;
            curl_close($curl);
            return json_decode($output,true);
        } 
}
