<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
class UserController extends Controller
{
    public function ser(){
        return view('user.user');
    }
    public function address(){
        $region = RegionModel::where('parent_id',0)->get();
        // $reg=json_encode(['data'=>$region]);
       
        return view('user.address',['region'=>$region]);
    }
}
