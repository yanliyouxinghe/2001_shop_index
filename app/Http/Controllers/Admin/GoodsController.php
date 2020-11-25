<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\CartgoryModel;
use App\Model\BrandModel;
use App\Model\GoodsTypeModel;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;

class GoodsController extends Controller
{
    //商品添加
    public function goods(){
         $data = CartgoryModel::all();
        $Ecsbrand = BrandModel::all();
        $type = GoodsTypeModel::all();
        // dd($data);
        $weight_list =  $this->weightTrees($data);
        return view('admin.goods.create',['weight_list'=>$weight_list,'Ecsbrand'=>$Ecsbrand,'type'=>$type]);
    }
     public function weightTrees($data,$parent_id=0,$level=0){
        if(!$data){
            return;
        }
       static  $res = [];
        foreach ($data as $key => $value) {
          if($value['parent_id'] == $parent_id){
              $value['level'] = $level;
              $res[] = $value;
              $this->weightTrees($data,$value['cat_id'],$level+1);
          }
        }
        return $res;
    }

    public function getattr(Request $request){
        $cat_id = $request->all();
        $attr = GoodsAttrModel::where('cat_id',$cat_id)->get();
        // dd($attr);
        return view('goods.typeattr',['attr'=>$attr]);
    }
    //商品列表
    public function goodslist(){
        return view('');
    }
}
