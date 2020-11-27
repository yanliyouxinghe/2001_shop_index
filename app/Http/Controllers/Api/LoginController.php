<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Model\UserModel;
use App\Common\jwt;
use App\Model\CodeModel;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
     //执行
    public function regdo(Request $request)
    {
        $user_plone = $request->post('user_plone');

        $user_pwd = $request->post('user_pwd');

        $user_pwds = $request->post('user_pwds');
        $code = $request->post('code');
        // $len = strlen($user_pwd);
        $codes=Redis::get('forgetcode');
   
         if($code!=$codes){  
            return [
                    'code'=>'00007',
                    'message'=>'验证码错误',
                    'result'=>''
                ];
        }
        $t = UserModel::where(['user_plone'=>$user_plone])->first();
        if($t){
             return [
                    'code'=>'00001',
                    'message'=>'手机号已存在',
                    'result'=>''
                ];
        }
        // if($len < 6){
        //      return [
        //             'code'=>'00003',
        //             'message'=>'密码长度不能小于六位',
        //             'result'=>''
        //         ];
        // }
        $user_pwd = password_hash($user_pwd,PASSWORD_BCRYPT);

       
        // $codes = 1111;

        // if($code==$codes){
             $data = [
            'user_plone' => $user_plone,
            'user_pwd'=>$user_pwd,
            ];
             $res = UserModel::insert($data);
             if(!$res){
             return [
                    'code'=>'00005',
                    'message'=>'注册失败',
                    'result'=>''
                ];
        }else{
             return [
                    'code'=>'00000',
                    'message'=>'注册成功',
                    'result'=>''
                ];
        }
    }
    //手机验证码验证
    public function sendSMS()
    {
        $name = request()->name;
        $code = rand(10000,999999);
        // $code ="11223";
        $result = $this->send($name,$code);
        if($result['Message']=='OK'){
            return  [
                    'code'=>00000,
                    'message'=>'发送成功',
                    'result'=>''
                ];
        }else{
            return  [
                    'code'=>00002,
                    'message'=>'发送失败',
                    'result'=>''
                ];
        }
    }
    //短信验证
    public function send($name,$code){
        Redis::del('forgetcode');
        Redis::setex('forgetcode',24*60*60,$code);
        AlibabaCloud::accessKeyClient('LTAI4GFccq2jJ5vjx9C1XNir', 'V97fmw5pHOmq5J0ij8RUZtQgdXDSko')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $name,
                        'SignName' => "龙龙小草",
                        'TemplateCode' => "SMS_182665157",
                        'TemplateParam' => "{code:$code}",
                    ],
                ])
                ->request();
            print_r($result->toArray());
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }
    }
    //执行登录
    public function logindo(Request $request){
        $data=$request->all();
        $user = UserModel::where(['user_plone'=>$data['user_plone']])->first();
        //   print_r($user);
          if(!$user){
              return json_encode(['code'=>'00003','msg'=>'没有此账号']);
          }else{
               $pwd=password_verify($data['user_pwd'],$user->user_pwd);
               if($pwd==$data['user_plone']){
                    $token =  jwt::instance()->setuid($user->user_id)->encode()->gettoken();
                    //   dd($token);
                    return json_encode(['code'=>'00000','msg'=>'登录成功','token'=>$token,'user'=>$user]);
                }else{
                    return json_encode(['code'=>'00002','msg'=>'账号密码错误']);
               }    
          }
    }
    public function getuserinfo(){
        $token = request()->header('token');
        if(!$token){
            return json_encode(['code'=>'00004','msg'=>'缺少参数']);
        }
        // dd($token);
        //验证token
        $jwt = jwt::instance();
        $jwt->decode($token);
      //  dd($jwt->checksign());
        if($jwt->validate() && $jwt->checksign()){
            //根据token获取UID
            $user_id = $jwt->getuid();
            // dd($uid);
        }
    }
}
