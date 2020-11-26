<?php
namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
use App\Model\ProductModel;
use PhpParser\Node\Stmt\Foreach_;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use Illuminate\Support\Facades\Redis;
class CartController extends Controller
{
    public function cart(){
        
        $cart = $this->getdata();
       return view('cart.cart',compact('cart'));
    }

    //购物车数据
    public function getdata(){
    $user_id = Redis::hget('reg','user_id');
    $data['user_id'] = $user_id;
    $url = "http://2001.shop.api.com/cart";
    $data_json = posturl($url,$data);
    //   print_r($data_json);die;
    return $data_json;
    }

    public function getattrprice(){
        $goods_attr_id = request()->goods_attr_id;
        $goods_id = request()->goods_id;
        // print_r($goods_id);die;
       $attr_price = Goods_AttrModel::whereIn('goods_attr_id',$goods_attr_id)
                    ->sum('attr_price');
                   //  dd($attr_price);
                //    print_r($attr_price);die;
        $shop_price=GoodsModel::where(['goods_id'=>$goods_id])->value('shop_price')+$attr_price;
        // print_r($shop_price);die;
       $shop_price = number_format($shop_price,2,".","");
       
    //   print_r($end_price);
       return json_encode(['code'=>0,'msg'=>'OK','data'=>$shop_price]);
    //    dd($end_price);
    }
    
    //加入购物车
    public function addcart(Request $request){
        $user_id = Redis::hget('reg','user_id');
        // dd($user_id);
        if(!$user_id){
            return json_encode(['code'=>'1001','msg'=>'请先登录']);
        }
            $goods_id=$request->goods_id;
            $buy_number= $request->buy_number;
            $goods_attr_id= $request->goods_attr_id;
            if(isset($goods_attr_id)){
                $attr_price = Goods_AttrModel::whereIn('goods_attr_id',$goods_attr_id)
                ->sum('attr_price');
                $shop_price=GoodsModel::where(['goods_id'=>$goods_id])->value('shop_price');
                $shop_price = $attr_price + $shop_price;



                //echo $shop_price;exit;
               $shop_price = number_format($shop_price,2,".","");
            }else{
                $shop_price=GoodsModel::where(['goods_id'=>$goods_id])->value('shop_price');
                $shop_price = number_format($shop_price,2,".","");
            }
            //print_r($shop_price);die;
        // $data=json_encode($data);
        
        // dd($data);

        // 判断商品id 购买数量 是否缺少参数
        if(!$goods_id || !$buy_number){
            return  json_encode(['code'=>'1003','msg'=>'缺少参数']);
        }
        $goods = GoodsModel::select('goods_id','goods_name','shop_price','is_show','goods_number','goods_sn')->where('goods_id',$goods_id)->first();
        // dd($goods);
        // dd($goods['is_show']);
        if($goods->is_show==0){
            return  json_encode(['code'=>'1004','msg'=>'商品已下架']);
        }
         //查询product的库存 购买数量大于库存  提示库存不足
        if(isset($goods_attr_id)){
            $goods_attr_id = implode('|',$goods_attr_id); //imploade 将数组用|分割成字符串
            // dump($goods_attr_id);
            // echo 123;
            $product = ProductModel::select('product_id','product_number','product_sn')->where(['goods_id'=>$goods_id,'goods_attr'=>$goods_attr_id])->first();

            if($product['product_number']>$buy_number){
                return json_encode(['code'=>'1005','msg'=>'商品库存不足']);
            }
        }else{
             $goods_number = GoodsModel::select('goods_id','goods_number','goods_sn')->where(['goods_id'=>$goods_id])->first();
            //  dump($goods_number);
             if($goods_number->goods_number<$buy_number){
                return json_encode(['code'=>'1005','msg'=>'商品库存不足']);
            }
        }
            //根据当前用户id ，商品id和规格判断购物车是否有次商品  没有添加入库  有更新购买数量
        //购买数量大于库存提示 把购物车数量改为最大库存 更新
        $cart = CartModel::where(['user_id'=>$user_id,'goods_id'=>$goods_id,'goods_attr_id'=>$goods_attr_id])->first();
        // print_r($cart);die;
        // dd($cart);
        if($cart){
            //更新购买数量

            $buy_number = $cart['buy_number']+$buy_number;
            $res = CartModel::where('cart_id',$cart->cart_id)->update(['buy_number'=>$buy_number]);
            if($res){
                return json_encode(['code'=>'0','msg'=>'添加成功']);
            }else{
                  return json_encode(['code'=>'3','msg'=>'添加失败']);
            }
        }else{
            //echo $shop_price;exit;
              //添加购物车
            $data = [
                'user_id'=>$user_id,
                'product_id'=>$product->product_id??0,
                'buy_number'=>$buy_number,
                'goods_attr_id'=>$goods_attr_id??'',
                'goods_sn'=>$product->product_sn??$goods->goods_sn,
                'shop_price'=>$shop_price
            ];
            $goods = $goods?$goods->toArray():[];
            unset($goods['shop_price']);
            $data = array_merge($data,$goods);
            unset($data['is_show']);
            unset($data['goods_number']);
            $res = CartModel::create($data);
            // dd($res);
            if($res){
                return json_encode(['code'=>'0','msg'=>'添加成功']);
            }else{
                return json_encode(['code'=>'1','msg'=>'添加失败']);
            }
        }
           
    }



    //购物车删除
    public function cart_del(){
        $user_id = "2";
        $data['user_id'] = $user_id;
        $data['cart_id'] = request()->cart_id;

        $url = "http://2001.shop.api.com/cart_del";
        $del_cart = posturl($url,$data);
       // dd($del_cart);
        // dd($del_cart['code']);
        if($del_cart['code'] == 0){
             return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙。。。']);
        }
    }


    //减号
    public function buy_jian(){
        $user_id = "2";
        $data['user_id'] = $user_id;
        $data['cart_id'] = request()->cart_id; 
        
        $url = "http://2001.shop.api.com/buy_jian";
        
        $buy_jian = posturl($url,$data);
        if($buy_jian['code'] == 0){
            return json_encode(['code'=>0,'msg'=>'OK','price'=>$buy_jian['data'][0]]);
        }else{
            return json_encode(['code'=>1,'msg'=>'不能再少了']);
        }
    }
    
    //加号
    public function buy_jia(){
        $user_id = "2";
        $data['user_id'] = $user_id;
        $data['cart_id'] = request()->cart_id;
        
        $url = "http://2001.shop.api.com/buy_jia";
        
        $buy_jia = posturl($url,$data);
        if($buy_jia['code'] == 0){
            return json_encode(['code'=>0,'msg'=>'OK','price'=>$buy_jia['data'][0]]);
        }else{
            return json_encode(['code'=>1,'msg'=>$buy_jia['msg']]);
        }
    }
   
    //购物车总价格
    public function cart_zprice(){
        $user_id = "2";
        $data['user_id'] = $user_id;
        $cart_ids = request()->cart_ids;
        $url = "http://2001.shop.api.com/cart_zprice";
        $zprice = posturl($url,$cart_ids);
        $zprices = $zprice['data'][0]['total'];
        if($zprices){
            return json_encode(['code'=>0,'msg'=>'OK','zprice'=>$zprices]);
        }else{
            return json_encode(['code'=>1,'msg'=>'Error']);
        }
    }


}

