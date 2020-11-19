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
     
        if($res){
          
            $address =  UseraddressModel::all();
         
            $data = json_encode(['code'=>0,'msg'=>'OK','data'=>$address]);
           
            echo  $callback.'('.$data.')';
        }
    }
    public function list(){
        $jyl = UseraddressModel::get();
        // dd($jyl);
        return view('user.address');
    }
}
