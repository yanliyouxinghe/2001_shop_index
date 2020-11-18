<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     
       $url = "http://2001.shop.api.com/logindo";
       $reg=$this->posturl($url,$data);
        dd($reg);

    }


    public function posturl($url,$data){
         
            $data  = json_encode($data);    
            
            $headerArray =["Content-type:application/json;charset='utf-8'","Accept:application/json"];
            $curl = curl_init();//初始化
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
            curl_setopt($curl, CURLOPT_POST, 1);//设置post提交
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//post提交表单数据
            curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
            curl_close($curl);
            return json_decode($output,true);
        } 
}
