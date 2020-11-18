<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
<<<<<<< HEAD
      protected $table = 'sh_goods';
=======
    protected $table = 'sh_goods';
>>>>>>> a805ec9dd8f56b3f421fa7c5e41cfd7aa0426337
      protected $guarded = [];
      protected $primaryKey = "goods_id";

      public $timestamps = false;
<<<<<<< HEAD

      //首页轮播图
      public static function getslicedata(){
            $where['is_show'] = 1;
            return self::select('goods_id','goods_img')->where($where)->take(3)->orderBy('goods_id','desc')->get();
      }
}

=======
}
>>>>>>> a805ec9dd8f56b3f421fa7c5e41cfd7aa0426337
