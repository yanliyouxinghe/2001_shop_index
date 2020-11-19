<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Model\UserModel;
use App\Common\jwt;
class LoginController extends Controller
{
     //执行
    public function regdo(Request $request)
    {
        $user_plone = $request->post('user_plone');
  
        $user_pwd = $request->post('user_pwd');
         
        $user_pwds = $request->post('user_pwds');
            // dd($user_pwds);
        $len = strlen($user_pwd);
        $t = UserModel::where(['user_plone'=>$user_plone])->first();
        if($t){
             $data=[
                    'code'=>00001,
                    'message'=>'手机号已存在',
                    'result'=>''
                ];
        }
        if($len<6){
             $data=[
                    'code'=>00003,
                    'message'=>'密码长度不能小于六位',
                    'result'=>''
                ];
        }
        if($user_pwds != $user_pwd){
             $data=[
                    'code'=>00004,
                    'message'=>'确认密码与密码不一致',
                    'result'=>''
                ];
        }
        $user_pwd = password_hash($user_pwd,PASSWORD_BCRYPT);
        $data = [
            'user_plone' => $user_plone,
            'user_pwd'=>$user_pwd
        ];
        $res = UserModel::insert($data);
        if(!$res){
             $data=[
                    'code'=>00005,
                    'message'=>'注册失败',
                    'result'=>''
                ];
        }else{
             $data=[
                    'code'=>00000,
                    'message'=>'注册成功',
                    'result'=>''
                ];
        }
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    //手机验证码验证
    public function sendSMS()
    {
        $name = request()->name;
    //    dd($name);
        $reg = '/^1[3|5|6|7|8|9]\d{9}$/';
        if(!preg_match($reg,$name)){
            $jyl=[
                    'code'=>00001,
                    'message'=>'请输入正确的手机号',
                    'result'=>''
                ];
        }
        $code = rand(10000,999999);
        $result = $this->send($name,$code);
        if($result['Message']=='OK'){
            $jyl=[
                    'code'=>00000,
                    'message'=>'发送成功',
                    'result'=>''
                ];
        }else{
            $jyl=[
                    'code'=>00002,
                    'message'=>'发送失败',
                    'result'=>''
                ];
        }
            return json_encode($jyl,JSON_UNESCAPED_UNICODE);
    }
    //短信验证
    public function send($name,$code){

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
            // dd($data);
          $user = UserModel::where(['user_plone'=>$data['user_plone']])->first();
        //   dd($user);
          if(!$user){
              return json_encode(['code'=>'00002','msg'=>'没有此账号或账号错误']);
          }
         // return json_encode($user,JSON_UNESCAPED_UNICODE);
        //   dd($user->user_id);
          $token =  jwt::instance()->setuid($user->user_id)->encode()->gettoken();
        //   dd($token);
        return json_encode(['code'=>'00000','msg'=>'登录成功','token'=>$token]);
        //   $data=json_encode($data,true);
           
        //   $user_plone=request()->$data['user_plone'];
        //   dd($user_plone);
        // $user_plone = $request->post('user_plone');
        
        // $user_pwd = $request->post('user_pwd');
        // dump($user_pwd);
        // $u = UserModel::where(['user_plone'=>$user_plone])->first();
        // if(!$u){
        //     $jyl=[
        //             'code'=>00002,
        //             'message'=>'没有此账号或账号错误',
        //             'result'=>''
        //         ];
        // }else{
        //     $res = password_verify($user_pwd,$u->user_pwd);
        //     if(!$res){
        //         $jyl=[
        //             'code'=>00001,
        //             'message'=>'密码错误',
        //             'result'=>''
        //         ];
        //     }else{
        //         session(['user_plone' => $u['user_plone']]);
        //         session(['user_id' => $u['user_id']]);
        //         session(['user_name' => $u['user_name']]);
        //         $request->session()->save();
        //         $jyl=[
        //             'code'=>00000,
        //             'message'=>'登录成功',
        //             'result'=>''
        //         ];
        //     }
        //    return json_encode($jyl,JSON_UNESCAPED_UNICODE);
        // }
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
            $uid = $jwt->getuid();
            // dd($uid);
        }
    }
}
