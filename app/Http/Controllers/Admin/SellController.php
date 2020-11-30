<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SeuserModel;
class SellController extends Controller
{
    //商家后台首页或者商家资料展示
    public function index(){

        $aes = SeuserModel::get();
        return view('admin.admin.index',['aes'=>$aes]);
    }
    //商家资料上传
    public function addindex(){
        return view('admin.admin.create');
    }
    //执行商家资料上传
    public function store(Request $Request){
        $data = $Request->except('_token');
         $goods = [
                        "firm_name" => $data['firm_name'],
                        "firm_tel" => $data['firm_tel'],
                        "firm_address" => $data['firm_address'],
                        "seuser_name" => $data['seuser_name'],
                        "seuser_qq"=> $data['seuser_qq'],
                        "seuser_email" => $data['seuser_email'],
                        "firm_img" => $data['firm_img'],
                        "firm_desc" => $data['firm_desc']
                    ];
        // print_r($post);
        $res = SeuserModel::insert($goods);
        if($res){
        return redirect('/index');
            }else{
        echo "<script>alert('操作繁忙请稍后重试');location.href='/store'</script>";
        }
    }
}
