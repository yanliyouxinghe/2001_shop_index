<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    //商家入驻
    public function reg(){
        return view('admin.business.union_reg');
    }
    //商家登录
    public function business(){
        return view('admin.business.union_login');
    }
}
