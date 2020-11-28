<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
use Illuminate\Support\Facades\Redis;
class UserController extends Controller
{
    
    public function address(){
        $region = RegionModel::where('parent_id',0)->get();
        // $reg=json_encode(['data'=>$region]);
        return view('user.address',['region'=>$region]);
    }


    public function ser(){
        $user=Redis::hmget('reg','user_id','user_plone');
        if(!$user){
            return redirect('/login');
        }
        $data['user_id'] = $user[0];
        $url = "http://2001.shop.api.com/user";
        $data_json = posturl($url,$data);
        $obligation = $data_json['data']['obligation'];
        $deliver = $data_json['data']['deliver'];
        $afrmm = $data_json['data']['afrmm'];
        $evaluate = $data_json['data']['evaluate'];
        $remote_addr = $data_json['data']['remote_addr'];
        $plone = $user[1];
        return view('user.user',compact('obligation','deliver','afrmm','evaluate','remote_addr','plone'));
    }

    public function userorderlist(){
        $user=Redis::hmget('reg','user_id','user_plone');
        if(!$user){
            return redirect('/login');
        }
        $data['user_id'] = $user[0];
        $url = "http://2001.shop.api.com/obligation";
        $data_json = posturl($url,$data);
        $data = $data_json['data'];
        return view('user.order_list',compact('data'));
        
    }


}
