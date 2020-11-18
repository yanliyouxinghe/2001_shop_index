<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>购物车</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="static/images/icon/favicon.ico" type="static/image/x-icon">
<link rel="stylesheet" type="text/css" href="static/css/style.css" /><script src="static/js/html5.js"></script>
<script src="static/js/jquery.js"></script>
<script>
$(document).ready(function(){
  $("nav .indexAsideNav").hide();
  $("nav .category").mouseover(function(){
	  $(".asideNav").slideDown();
	  });
  $("nav .asideNav").mouseleave(function(){
	  $(".asideNav").slideUp();
	  });
});
</script>
</head>
<body>
<!--header-->
 @include('layout.header')
 <script>
 $(document).ready(function(){
   //测试效果，程序对接如需变动重新编辑
   $(".switchNav li").click(function(){
     $(this).addClass("active").siblings().removeClass("active");
     });
   $("#chanpin").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入产品关键词或货号");
     });
   $("#shangjia").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入商家店铺名");
     });
   $("#zixun").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入关键词查找文章内容");
     });
   $("#wenku").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入关键词查找文库内容");
     });
   });
   
 </script>
 @if(count($cart['data']) > 0)
<section class="wrap" style="margin-top:20px;overflow:hidden;">
 <table class="order_table">
  <tr>
   <th><input type="checkbox"/></th>
   <th>产品</th>
   <th>名称</th>
   <th>属性</th>
   <th>单价</th>
   <th>数量</th>
   <th>小计</th>
   <th>操作</th>
  </tr>

   @foreach($cart['data'] as $v)
  <tr>
   <td class="center"><input type="checkbox"/></td>
   <td class="center"><a href="product.html"><img src="{{$v['goods_thumb']}}" style="width:50px;height:50px;"/></a></td>
   <td><a href="product.html">{{$v['goods_name']}}</a></td>
   <td>
    <p>颜色：黑色</p>
    
    <p>规格：M码</p>
   </td>
   <td class="center"><span class="rmb_icon">{{$v['shop_price']}}</span></td>
   <td class="center">
    <input type="button" value="-" class="jj_btn"/>
    <input type="text" value="{{$v['buy_number']}}" class="number" readonly/>
    <input type="button" value="+" class="jj_btn"/>
   </td>
   <td class="center"><strong class="rmb_icon">9.00</strong></td>
   <td class="center"><a>删除</a></td>
  </tr>
   @endforeach

 </table>
 <div class="order_btm_btn">
  <a href="/" class="link_btn_01 buy_btn"/>继续购买</a>
  <a href="order_confirm.html" class="link_btn_02 add_btn"/>共计金额<strong class="rmb_icon">0.00</strong>立即结算</a>
 </div>
</section>
@else
<center><table>
      <tr>
        <td><img src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=2601129021,2880906803&fm=26&gp=0.jpg" alt=""></td>
        <td> <div class="order_btm_btn">
              <h1 style="color:red">购物车空空的哦~，去看看心仪的商品吧~</h1>
              <a href="/" class="link_btn_01 buy_btn"/>去购物</a>
            </div>
       </td>
      </tr>
    </table>
</center>
@endif



<!--footer-->
@include('layout.foot');
</body>
</html>
