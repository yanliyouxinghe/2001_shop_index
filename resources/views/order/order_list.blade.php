<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>用户中心</title>
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
 
<section class="wrap user_center_wrap">
@include('layout.myorder')
 <!--右侧：内容区域-->
 <div class="user_rt_cont">
  <div class="top_title">
   <strong>我的订单</strong>
  </div>
  <!--条件检索-->
  <div style="margin:8px 0;">
   <select class="select">
    <option>订单状态</option>
    <option>待付款</option>
    <option>待发货</option>
    <option>待确认</option>
    <option>待评价</option>
    <option>退货</option>
   </select>
   <input type="text" class="textbox textbox_225" placeholder="输入订单编号"/>
   <input type="button" value="查询" class="group_btn"/>
  </div>
  <ul class="order_li">
   <li>
    <table class="order_table">
     <caption>
      <strong>订单编号：201301141637</strong>
      <em class="shop_name">一号店</em>
      <a href="order_detail.html">订单详情</a>
     </caption>
     <tr>
      <td class="center"><a href="product.html"><img src="static/upload/goods009.jpg" style="width:50px;height:50px;"/></a></td>
      <td><a href="product.html">这里是产品名称哦</a></td>
      <td class="center"><span class="rmb_icon">52.00</span></td>
      <td class="center"><b>1</b></td>
      <td class="center"><strong class="rmb_icon">52.00</strong></td>
      <td class="center"><a class="a_btn">付款</a></td>
     </tr>
    </table>
   </li>
   <li>
    <table class="order_table">
     <caption>
      <strong>订单编号：201301141637</strong>
      <em class="shop_name">二号店</em>
      <a href="order_detail.html">订单详情</a>
     </caption>
     <tr>
      <td class="center"><a href="product.html"><img src="static/upload/goods009.jpg" style="width:50px;height:50px;"/></a></td>
      <td><a href="product.html">这里是产品名称哦</a></td>
      <td class="center"><span class="rmb_icon">52.00</span></td>
      <td class="center"><b>1</b></td>
      <td class="center"><strong class="rmb_icon">52.00</strong></td>
      <td class="center"><a class="a_btn">确认收货</a></td>
     </tr>
    </table>
   </li>
   <li>
    <table class="order_table">
     <caption>
      <strong>订单编号：201301141637</strong>
      <em class="shop_name">二号店</em>
      <a href="order_detail.html">订单详情</a>
     </caption>
     <tr>
      <td class="center"><a href="product.html"><img src="static/upload/goods009.jpg" style="width:50px;height:50px;"/></a></td>
      <td><a href="product.html">这里是产品名称哦</a></td>
      <td class="center"><span class="rmb_icon">52.00</span></td>
      <td class="center"><b>1</b></td>
      <td class="center"><strong class="rmb_icon">52.00</strong></td>
      <td rowspan="2" class="center"><a href="order_comment.html" class="a_btn">评价</a></td>
     </tr>
     <tr>
      <td class="center"><a href="product.html"><img src="static/upload/goods009.jpg" style="width:50px;height:50px;"/></a></td>
      <td><a href="product.html">这里是产品名称哦</a></td>
      <td class="center"><span class="rmb_icon">52.00</span></td>
      <td class="center"><b>1</b></td>
      <td class="center"><strong class="rmb_icon">52.00</strong></td>
      </tr>
    </table>
   </li>
   <li>
    <table class="order_table">
     <caption>
      <strong>订单编号：201301141637</strong>
      <em class="shop_name">三号店</em>
      <a href="order_detail.html">订单详情</a>
     </caption>
     <tr>
      <td class="center"><a href="product.html"><img src="static/upload/goods009.jpg" style="width:50px;height:50px;"/></a></td>
      <td><a href="product.html">这里是产品名称哦</a></td>
      <td class="center"><span class="rmb_icon">52.00</span></td>
      <td class="center"><b>1</b></td>
      <td class="center"><strong class="rmb_icon">52.00</strong></td>
      <td class="center"><span>交易成功</span></td>
     </tr>
    </table>
   </li>
  </ul>
   <!--分页-->
   <div class="paging" style="text-align:right">
    <a>第一页</a>
    <a class="active">2</a>
    <a>3</a>
    <a>...</a>
    <a>89</a>
    <a>最后一页</a>
   </div>
 </div>
</section>
<!--footer-->
@include('layout.foot')
</body>
</html>
