<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\CartgoryModel;
use App\Model\BrandModel;
use App\Model\GoodsTypeModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use App\Model\Goods_GalleryModel;
use App\Models\SegoodsModel;
use App\Models\SeproductModel;

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
    public function store(Request $request)
    {
              
    }

        public function pruct(){
            $post = request()->all();
            if(count($post['attr'])){
                $attr = $post['attr'];
                // dump($post);
                $firstkey = array_key_first($attr);
                $count = count($attr[$firstkey]);
                for($i = 0; $i<$count; $i++){
                    $new_attr[] = array_column($attr,$i);
                }

                $product = [];
                foreach($new_attr as $k=>$v){
                    $product[] = [
                        'goods_id' => $post['goods_id'],
                        'goods_attr' => implode('|',$v),
                        'product_sn' => $post['product_sn'][$k]?:$this->addProduct(),
                        'product_number' => $post['product_number'][$k]?:'1',
                    ];
                }
                $srt = SeproductModel::insert($product);
                //dd($srt);
                if($srt){
                    return redirect('/goods/list');
                }else{
                    echo "<script>alert('操作繁忙请稍后重试');location.href='/goods/create'</script>";

                }
            }
        }

        public function addProduct(){
            return 'ECS'.time().rand(1000,9999);
        }
    public function getattr(Request $request){
        $cat_id = $request->all();
        $attr = GoodsAttrModel::where('cat_id',$cat_id)->get();
        // dd($attr);
        return view('admin.goods.typeattr',['attr'=>$attr]);
    }
      public function Attrnum($goods_id){
            $res =  Goods_AttrModel::select('goods_attr_id','sh_goods_attr.attr_id','sh_attribute.attr_name','sh_goods_attr.attr_value')
                    ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
                    ->where(['goods_id'=>$goods_id,'attr_type'=>1])
                    ->get();
                    // print_r($res);
            return $res ? $res->toArray() : [];

    }
    //商品列表
    public function goodslist(){
        return view('admin.goods.list');
    }
}
