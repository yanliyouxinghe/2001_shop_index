<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
use App\Model\Order_GoodsModel;
use App\Model\Order_InfoModel;
use App\Model\CartModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Log;
use function AlibabaCloud\Client\redTable;
use Illuminate\Support\Facades\Redis;
use App\Model\CouponsModel;
use App\Model\User_CouponsModel;
use App\Model\CrtModel;
class OrderController extends Controller
{

    public function order(){

        return view('order.order_list');
    }

    /**提交订单视图 */
    public function index(){
        $post = request()->all();
        $cart_id = $post['cart_id'];
        $goods_id = $post['goods_id'];

        $user_id=Redis::hget('reg','user_id');
        if(!$user_id){
            return redirect('/login');
        }
        $data['user_id']=$user_id;
        //展示收货人信息
        $url = 'http://2001.shop.api.com/addressinfo';
        $addressinfo = posturl($url,$data);
        //展示购物车商品数据
        //结算购物车
        $data['cart_id'] = request()->cart_id;
        if(!$data['cart_id']){
            return redirect('/cart');
        }
        $url = "http://2001.shop.api.com/account";
        $account = posturl($url,$data);
        $coupons = $account['data']['coupons'];
        // print_r($coupons);die;
        //使用优惠券
        // $url = 'http://2001.shop.api.com/couponsuse/'.$goods_id;
        // $coupons=geturl($url);
        return view('order.order',['addressinfo'=>$addressinfo['data'],'account'=>$account['data'],'coupons'=>$coupons,'goods_id'=>$goods_id,'cart_id'=>$cart_id]);
    }
    

    /**收货地址ajax删除 */
    public function address_del(){
        $data['address_id'] = request()->address_id;
        $user_id=Redis::hget('reg','user_id');
        $data['user_id']=$user_id;
        $url = 'http://2001.shop.api.com/address_del';
        $address_del = posturl($url,$data);
        // print_r($address_del);die;
        if($address_del['data']['count_address'] ==1){
            return json_encode(['code'=>2,'msg'=>'Error']);
        }
        if($address_del['code']==0){
            return json_encode(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙']);
        }
    }



    //修改收货地址默认、
    public function mor(){
        $user_id=Redis::hget('reg','user_id');
        if(!$user_id){
            return redirect('/login');
        }
        $data['user_id']=$user_id;
        $data['address_id'] = request()->input('address_id');
        $url = 'http://2001.shop.api.com/mor';
        $mor = posturl($url,$data);
        if($mor['code']==0){
            return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙']);
        }
    }

        public function orderinfo(){
            $goods_id = request()->goods_id;
            $goods_id=implode(',',$goods_id);
            $goods_id=explode(',',$goods_id);
            // print_r($goods_id);die;
            $goods_attr_id = request()->goods_attr_id;
            $goods_attr_id= explode('|',$goods_attr_id);
            $coupons_id = request()->coupons_id;
            $attr_price = Goods_AttrModel::whereIn('goods_attr_id',$goods_attr_id)
            ->sum('attr_price');
            // print_r($attr_price);die;            
               //  dd($attr_price);
                //    print_r($attr_price);die;
        $shop_price=GoodsModel::whereIn('goods_id',$goods_id)->sum('shop_price')+$attr_price;
        // print_r($shop_price);die;
        $coupons_price=CouponsModel::where(['coupons_id'=>$coupons_id])->value('coupons_price');
        // print_r($coupons_price);die;
        $deal_price=$shop_price-$coupons_price;
        // print_r($deal_price);die;
       $deal_price = number_format($deal_price,2,".","");


            $user_id=Redis::hget('reg','user_id');
            if(!$user_id){
                return json_encode(['code'=>1,'msg'=>'Error,请登录']);
            }
            $datas = request()->all();
            $cart_id = explode(',',$datas['cart_id']);
            if(empty($datas['address_id']) || empty($datas['pay_type']) || empty($datas['cart_id']) || empty($datas['total_price'])){
                return json_encode(['code'=>2,'msg'=>'Error,参数丢失']);
            }

            

            if($datas['pay_type']==1){
                $datas['pay_name'] = "支付宝";
            }else if($datas['pay_type']==2){
                $datas['pay_name'] = "微信支付";
            }else if($datas['pay_type']==3){
                $datas['pay_name'] = "货到付款";
            }else if($datas['pay_type']==4){
                $datas['pay_name'] = "余额支付";
            }


            DB::beginTransaction();
           
            try {
                $order_sn = $this->order_sn($user_id);
                $addressdatas = UseraddressModel::where(['user_id'=>$user_id,'address_id'=>$datas['address_id']])->get();
                $addressdata = $addressdatas[0];
                $data = [
                    'order_sn' => $order_sn,
                    'user_id' => $user_id,
                    'email' => $addressdata->email,
                    'consignee' => $addressdata->consignee,
                    'country' => $addressdata->country,
                    'province' => $addressdata->province,
                    'city' => $addressdata->city,
                    'district' => $addressdata->district,
                    'address' => $addressdata->address,
                    'zipcode' => $addressdata->zipcode,
                    'tel' => $addressdata->tel,
                    'pay_type' => $datas['pay_type'],
                    'pay_name' => $datas['pay_name'],
                    'total_price' => $datas['total_price'],
                    'deal_price' => $shop_price,
                    'addtime' => time(),
                    'order_leave'=>$datas['order_leave']
                ];
    
                $order_id = Order_InfoModel::insertGetId($data);
                $goodsinfo = CartModel::select('sh_cart.goods_id','sh_cart.goods_sn','sh_cart.product_id','sh_cart.goods_name','sh_cart.shop_price','sh_cart.buy_number','sh_cart.goods_attr_id')
                        ->whereIn('cart_id',$cart_id)
                        ->get();
                if(!count($goodsinfo->toArray())){
                    throw new Exception('购物车内没有此商品');
                }
                        $goods_data = [];
                        foreach($goodsinfo as $k=>$v){
                            $goods_data[$k]['order_id'] = $order_id;
                            $goods_data[$k]['goods_id'] = $v->goods_id;
                            $goods_data[$k]['goods_sn'] = $v->goods_sn;
                            $goods_data[$k]['product_id'] = $v->product_id;
                            $goods_data[$k]['goods_name'] = $v->goods_name;
                            $goods_data[$k]['shop_price'] = $v->shop_price;
                            $goods_data[$k]['buy_number'] = $v->buy_number;
                            $goods_data[$k]['goods_attr_id'] = $v->goods_attr_id?$v->goods_attr_id:'';
    
                        }
                        // print_r($goods_data);die;
                $ret = Order_GoodsModel::insert($goods_data);
                if($ret){
                    User_CouponsModel::where(['user_id'=>$user_id,'coupons_id'=>$coupons_id])->update(['coupons_state'=>1]);
                }
                foreach($cart_id as $k=>$v){
                    CartModel::destroy($v);
                }
                DB::commit();
                return json_encode(['code'=>0,'msg'=>'订单生成成功','data'=>$order_id]);
            } catch (\Exception $e) {
                DB::rollBack();
                //echo $e->getMessage();
                return json_encode(['code'=>3,'msg'=>'订单生成失败']);
            }

        }

        //生成惟一的订单号
        public function order_sn($user_id){
            $order_sn = rand(100000,999999).$user_id.time();
            $is_cf = Order_InfoModel::where(['order_sn'=>$order_sn])->first();
            if($is_cf){
                $this->order_sn($user_id);
            }else{
                return $order_sn;
            }
            

        }
    
}
