<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
     protected $table = 'sh_goods';
      protected $guarded = [];
      protected $primaryKey = "goods_id";
      public $timestamps = false;
      //首页轮播图
      public static function getslicedata(){
            $where['is_show'] = 1;
            return self::select('goods_id','goods_img')->where($where)->take(3)->orderBy('goods_id','desc')->get();
      }
}
