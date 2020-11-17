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
  <tr>
   <td class="center"><input type="checkbox"/></td>
   <td class="center"><a href="product.html"><img src="static/upload/goods.jpg" style="width:50px;height:50px;"/></a></td>
   <td><a href="product.html">这里是产品名称</a></td>
   <td>
    <p>颜色：黑色</p>
    
    <p>规格：M码</p>
   </td>
   <td class="center"><span class="rmb_icon">15.88</span></td>
   <td class="center">
    <input type="button" value="-" class="jj_btn"/>
    <input type="text" value="1" class="number" readonly/>
    <input type="button" value="+" class="jj_btn"/>
   </td>
   <td class="center"><strong class="rmb_icon">9.00</strong></td>
   <td class="center"><a>删除</a></td>
  </tr>
  <tr>
   <td class="center"><input type="checkbox"/></td>
   <td class="center"><a href="product.html"><img src="static/upload/goods007.jpg" style="width:50px;height:50px;"/></a></td>
   <td style="width:200px;"><a href="product.html">这里是产品名称</a></td>
   <td>
    <p>颜色：黑色</p>
    
    <p>规格：M码</p>
   </td>
   <td class="center"><span class="rmb_icon">15.88</span></td>
   <td class="center">
    <input type="button" value="-" class="jj_btn"/>
    <input type="text" value="1" class="number"/>
    <input type="button" value="+" class="jj_btn"/>
   </td>
   <td class="center"><strong class="rmb_icon">9.00</strong></td>
   <td class="center"><a>删除</a></td>
  </tr>
  <tr>
   <td class="center"><input type="checkbox"/></td>
   <td class="center"><a href="product.html"><img src="static/upload/goods008.jpg" style="width:50px;height:50px;"/></a></td>
   <td style="width:200px;"><a href="product.html">这里是产品名称</a></td>
   <td>
    <p>颜色：黑色</p>
    
    <p>规格：M码</p>
   </td>
   <td class="center"><span class="rmb_icon">15.88</span></td>
   <td class="center">
    <input type="button" value="-" class="jj_btn"/>
    <input type="text" value="1" class="number"/>
    <input type="button" value="+" class="jj_btn"/>
   </td>
   <td class="center"><strong class="rmb_icon">9.00</strong></td>
   <td class="center"><a>删除</a></td>
  </tr>
 </table>
 <div class="order_btm_btn">
  <a href="index.html" class="link_btn_01 buy_btn"/>继续购买</a>
  <a href="order_confirm.html" class="link_btn_02 add_btn"/>共计金额<strong class="rmb_icon">0.00</strong>立即结算</a>
 </div>
</section>
<!--footer-->
@include('layout.foot');
</body>
</html>
