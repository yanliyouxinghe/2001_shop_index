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
     //文件上传
     public function upload(Request $request)
     {
         //接收文件上传的值
         $photo = $request->file();
         //判断文件上传是否有文件或者有没有出错
         if ($request->hasFile('file') && $request->file('file')->isValid()) {
         $photo = $request->file('file');
 //        dd($photo);
         //文件上传
         $store_result = $photo->store("upload");
             $store_results = '/'.$store_result;
         //返回json
         if($request->ajax()){
            return json_encode(['code'=>0,'msg'=>'上传成功','data'=>['src'=>$store_results,'title'=>'']]);
         }
         return $store_results;
 //            dd($store_result);die;
             // return $this->JsonResponse('0','上传成功',$store_results);

         }
         return json_encode(['code'=>1,'msg'=>'文件上传失败']);

     }
      //文件上传

    public function uploads(Request $request)
    {
        //接收文件上传的值
        $photo = $request->file();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $photo = $request->file('file');
        //文件上传
        $store_result = $photo->store("upload");
            $store_results = '/'.$store_result;
            return json_encode(['code'=>0,'msg'=>'上传成功','data'=>$store_results]);
        }
        return json_encode(['code'=>1,'msg'=>'文件上传失败']);

    }
    
    public function getattr(Request $request){
        $cat_id = $request->all();
        $attr = GoodsAttrModel::where('cat_id',$cat_id)->get();
        // dd($attr);
        return view('admin.goods.typeattr',['attr'=>$attr]);
    }
    //商品列表
    public function goodslist(){
        return view('');
    }
}
