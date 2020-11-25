<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
use Illuminate\Support\Facades\Redis;
class UserController extends Controller
{
     public function getsondata(Request $request){
    	$region_id  = $request->region_id; 
    	$region_son = RegionModel::where('parent_id',$region_id)->get();
    	return json_encode(['code'=>0,'msg'=>'OK','data'=>$region_son]);
    }
    public function store(Request $request){
         $callback=$request->callback;
        $post = $request->except(['_token','callback','_']);
      
        $user_id=Redis::hget('reg','user_id');
        $post['user_id'] = $user_id;
       // print_r($post);exit;
         $res = UseraddressModel::insert($post);
<<<<<<< HEAD
         // var_dump($res);die;
         $address = array();
=======
        
        return redirect('/');die;
>>>>>>> 0fe8ee232b2f67b6030b2649095e9e7c0c5e7a68
        if($res){
            $address =  UseraddressModel::where(['user_id'=>$user_id])->get();
            // print_r($address);
            $reg = new RegionModel;
             foreach($address as $k=>$v){
                $address[$k]->country = $reg->where('region_id',$v->country)->value('region_name'); 
                $address[$k]->province = $reg->where('region_id',$v->province)->value('region_name');
                $address[$k]->city = $reg->where('region_id',$v->city)->value('region_name');
                $address[$k]->district = $reg->where('region_id',$v->district)->value('region_name');
                $address[$k]->tel = substr($v->tel,0,3)."****".substr($v->tel,7,4);
            }
        //    var_dump($address);
        }
       // $address = $address->toArray();
        $data = array(
            'code'=>0,
            'msg'=>'ok',
            'data'=>$address
        );
      
            echo  $callback.'('.json_encode($data).')';
    }
}
