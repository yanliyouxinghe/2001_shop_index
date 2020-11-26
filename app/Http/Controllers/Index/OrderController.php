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
use Illuminate\Support\Facades\DB;
use Log;
use function AlibabaCloud\Client\redTable;
use Illuminate\Support\Facades\Redis;
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
        return view('order.order',['addressinfo'=>$addressinfo['data'],'account'=>$account['data'],'goods_id'=>$goods_id,'cart_id'=>$cart_id]);
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

    /**支付 */
    public function pay($order_id){
        $config = config('alipay');

        require_once app_path('Common/lib/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('Common/lib/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');

        $order_info = Order_InfoModel::find($order_id);

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $order_info->order_sn;
        $goods_name = Order_GoodsModel::where('order_id',$order_id)->pluck('goods_name')->toArray();

        //订单名称，必填
        $subject = implode("\r\n",$goods_name);

        //付款金额，必填
        $total_amount = $order_info->order_price;

        //商品描述，可空
        $body = '';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);
    }

    /**支付宝同步跳转 */
    public function return_url(){
        $config = config('alipay');
        
        require_once app_path('Common/lib/alipay/pagepay/service/AlipayTradeService.php');

        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config); 
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            //请在这里加上商户的业务逻辑程序代码
            $count = Order_InfoModel::where(['order_sn'=>$arr['out_trade_no'],'order_price'=>$arr['total_amount']])->count();
            //2.验证订单号和订单金额
            if(!$count){
            return '发送重大事故:订单号'.$arr['out_trade_no'].'和订单金额'.$arr['total_amount'].'不在当前系统中!请联系客服';
            }
            //3、校验通知中的商家seller_id     //登录沙箱  沙箱账号 里面有商家UID
            if($arr['seller_id']!=config('alipay.seller_id')){
                return '发生重大事故:商家UID'.$arr['seller_id'].'与系统商家不符!请联系客服';
            }
            //4、验证app_id是否为该商户本身。
            if($arr['app_id']!=config('alipay.app_id')){
                return '发生重大事故:应用UID'.$arr['app_id'].'与系统商家不符!请联系客服';
            }
            //5.更改订单状态和支付状态
            $data = [
                'pay_status'=>2,    //支付状态1 待支付 2 已支付
                'order_status'=>1      //0未确认 1 确认 2已取消 3无效 4退货
            ];
            $res = Order_InfoModel::where(['order_sn'=>$arr['out_trade_no']])->update($data);
            if($res){
                return redirect('/user/myorder');
            }
            
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }

    /**支付宝异步通知 */
    public function notify_url(){
        // Log::info('支付宝异步通知');
        // die;
        $config = config('alipay');
        require_once app_path('Common/lib/alipay/pagepay/service/AlipayTradeService.php');

        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config); 
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //请在这里加上商户的业务逻辑程序代
        $count = Order_InfoModel::where(['order_sn'=>$arr['out_trade_no'],'order_price'=>$arr['total_amount']])->count();
        //2.验证订单号和订单金额
        $error = '';
        if(!$count){
            $error ='发送重大事故:订单号'.$arr['out_trade_no'].'和订单金额'.$arr['total_amount'].'不在当前系统中!请联系客服';
        }
        //3、校验通知中的商家seller_id     //登录沙箱  沙箱账号 里面有商家UID
        if($arr['seller_id']!=config('alipay.seller_id')){
            $error = '发生重大事故:商家UID'.$arr['seller_id'].'与系统商家不符!请联系客服';
        }
        //4、验证app_id是否为该商户本身。
        if($arr['app_id']!=config('alipay.app_id')){
            $error = '发生重大事故:应用UID'.$arr['app_id'].'与系统商家不符!请联系客服';
        }

        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        
        //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
        
        //商户订单号

        $out_trade_no = $_POST['out_trade_no'];

        //支付宝交易号

        $trade_no = $_POST['trade_no'];

        //交易状态
        $trade_status = $_POST['trade_status'];


        if($_POST['trade_status'] == 'TRADE_FINISHED') {

            //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
            //如果有做过处理，不执行商户的业务程序
                    
            //注意：
            //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
                }
                else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                    //判断该笔订单是否在商户网站中已经做过处理
                    $data = [
                        'pay_status'=>2,    //支付状态1 待支付 2 已支付
                        'order_status'=>1      //0未确认 1 确认 2已取消 3无效 4退货
                    ];
                    $res = Order_InfoModel::where(['order_sn'=>$arr['out_trade_no']])->update($data);
                    if($res){
                        $error = "此商户订单:".$out_trade_no."同步跳转没有更新状态,异步跳转处理成功";
                        return redirect('/user/myorder');
                    }

                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序			
                    //注意：
                    //付款完成后，支付宝系统发送该交易状态通知
                }
                //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                echo "success";	//请不要修改或删除
            }else {
                //验证失败
                echo "fail";

            }
    }


        public function orderinfo(){
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
                    // 'deal_price' => $datas['deal_price'],
                    'addtime' => time(),
                    'order_leave'=>$datas['order_leave']
                ];
    
                $order_id = Order_InfoModel::insertGetId($data);
                $goodsinfo = CartModel::select('sh_cart.goods_id','sh_cart.goods_sn','sh_cart.product_id','sh_cart.goods_name','sh_cart.shop_price','sh_cart.buy_number','sh_cart.goods_attr_id')
                        ->whereIn('cart_id',$cart_id)
                        ->where('is_del',1)
                        ->get();
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
                foreach($cart_id as $k=>$v){
                    CartModel::where(['cart_id'=>$v])->update(['is_del'=>2]);
                }
                DB::commit();
                return json_encode(['code'=>2,'msg'=>'订单生成成功','data'=>$order_id]);
            } catch (\Throwable $th) {
                DB::rollBack();
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
