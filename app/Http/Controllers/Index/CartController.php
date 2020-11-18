<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function cart(){

        $cart = $this->getdata();
        // dd($cart);
       return view('cart.cart',compact('cart'));
    }


    public function getdata(){
    $url = "http://2001.shop.api.com/cart";
    $data_json = geturl($url);
    return $data_json;
    }

}
