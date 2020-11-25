<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
class UserController extends Controller
{
     public function getsondata(Request $request){
    	$region_id  = $request->region_id; 
    	$region_son = RegionModel::where('parent_id',$region_id)->get();
    	return json_encode(['code'=>0,'msg'=>'OK','data'=>$region_son]);
    }
    public function store(Request $request){
        
        $post = $request->except(['_token','callback','_']);
        $callback=$request->callback;
        // dd($post);
         $res = UseraddressModel::insert($post);
        
        return redirect('/');die;
        if($res){
            $address =  UseraddressModel::all();
            $reg = new RegionModel;
             foreach($address as $k=>$v){
            $address[$k]['country'] = $reg->where('region_id',$v->country)->value('region_name'); 
            $address[$k]['province'] = $reg->where('region_id',$v->province)->value('region_name');
            $address[$k]['city'] = $reg->where('region_id',$v->city)->value('region_name');
            $address[$k]['district'] = $reg->where('region_id',$v->district)->value('region_name');
            $address[$k]['tel'] = substr($v->tel,0,3)."****".substr($v->tel,7,4);
        }
            $data = json_encode(['code'=>0,'msg'=>'OK','data'=>$address]);
            echo  $callback.'('.$data.')';
        }
    }
}
