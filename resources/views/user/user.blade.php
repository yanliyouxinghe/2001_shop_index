﻿<!DOCTYPE html>
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
<header>
  <!--topNavBg-->
  @include('layout.header');
  <!--logoArea-->
  <div class="wrap logoSearch">
   <!--logo-->
   <div class="logo">
    <h1><img src="static/images/logo.png"/></h1>
   </div>
   <!--search-->
   <div class="search">
    <ul class="switchNav">
     <li class="active" id="chanpin">产品</li>
     <li id="shangjia">商家</li>
     <li id="zixun">搭配</li>
     <li id="wenku">文库</li>
    </ul>
    <div class="searchBox">
     <form>
      <div class="inputWrap">
      <input type="text" placeholder="输入产品关键词或货号"/>
      </div>
      <div class="btnWrap">
      <input type="submit" value="搜索"/>
      </div>
     </form>
     <a href="#" class="advancedSearch">高级搜索</a>
    </div>
   </div>
  </div>
  <!--nav-->
  <nav>
<ul class="wrap navList">
<li class="category">
<a>全部产品分类</a>
<dl class="asideNav indexAsideNav">
<dt><a href="channel.html">女装</a></dt>
<dd>
<a href="#">夏装新</a>
<a href="#">连衣裙</a>
<a href="#">T恤</a>
<a href="#">衬衫</a>
<a href="#">裤子</a>
<a href="#">牛仔裤</a>
<a href="#">背带裤</a>
<a href="#">短外套</a>
<a href="#">时尚外套</a>
<a href="#">风衣</a>
<a href="#">毛衣</a>
<a href="#">背心</a>
<a href="#">吊带</a>
<a href="#">民族服装</a>
</dd>
<dt><a href="channel.html">男装</a></dt>
<dd>
<a href="#">衬衫</a>
<a href="#">背心</a>
<a href="#">西装</a>
<a href="#">POLO衫</a>
<a href="#">马夹</a>
<a href="#">皮衣</a>
<a href="#">毛衣</a>
<a href="#">针织衫</a>
<a href="#">牛仔裤</a>
<a href="#">外套</a>
<a href="#">夹克</a>
<a href="#">卫衣</a>
<a href="#">风衣</a>
<a href="#">民族风</a>
<a href="#">原创设计</a>
<a href="#">大码</a>
<a href="#">情侣装</a>
<a href="#">开衫</a>
<a href="#">运动裤</a>
<a href="#">工装裤</a>
</dd>
</dl>
</li>
<li>
<a href="index.html" class="active">首页</a>
</li>
<li>
<a href="#">时尚搭配</a>
</li>
<li>
<a href="channel.html">原创设计</a>
</li>
<li>
<a href="channel.html">时尚代购</a>
</li>
<li>
<a href="channel.html">民族风</a>
</li>
<li>
<a href="information.html">时尚搭配</a>
</li>
<li>
<a href="library.html">搭配知识</a>
</li>
<li>
<a href="#">促销专区</a>
</li>
<li>
<a href="#">其他</a>
</li>
</ul>
</nav>

 </header>
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

   <!-- 个人订单 -->
   @include('layout.myorder')


 <!--右侧：内容区域-->
 <div class="user_rt_cont">
  <div class="top_title">
   <strong><em>DeathGhost</em>欢迎回到用户中心</strong>
  </div>
  <!--用户信息-->
  <div class="user_factbook">
   <a href="profile.html" class="user_icon">
    <img src="static/images/icon/DefaultAvatar.jpg"/>
    <span>修改头像</span>
   </a>
   <div class="user_infor">
    <p><strong>DeathGhost</strong>（商户会员）<span class="user_vip unaccredited">未认证！</span><a href="authenticate.html">申请入驻</a></p><!--**未认证的class值为"unaccredited"**-->
    <p>上次登录时间：<time>2013-01-14 13:55</time>，登录ip：192.168.1.1</p>
    <p>账户余额：<strong class="rmb_icon">0.00</strong><a href="account.html" class="btn">充值</a><a href="account.html" class="btn">提现</a></p>
   </div>
  </div>
  <!--买家订单提醒-->
  <dl class="user_order_tips">
   <dt>买家订单提醒</dt>
   <dd>
    <a href="order_list.html">
     <strong>20</strong>
     <em>待付款订单</em>
    </a>
   </dd>
   <dd>
    <a href="order_list.html">
     <strong>10</strong>
     <em>待发货订单</em>
    </a>
   </dd>
   <dd>
    <a href="order_list.html">
     <strong>30</strong>
     <em>待确认订单</em>
    </a>
   </dd>
   <dd>
    <a href="order_list.html">
     <strong>15</strong>
     <em>待评价订单</em>
    </a>
   </dd>
  </dl>
  <!--卖家订单提醒-->
  <dl class="user_order_tips">
   <dt>卖家订单提醒</dt>
   <dd>
    <a href="#">
     <strong>9</strong>
     <em>待付款订单</em>
    </a>
   </dd>
   <dd>
    <a href="#">
     <strong>10</strong>
     <em>待发货订单</em>
    </a>
   </dd>
   <dd>
    <a href="#">
     <strong>20</strong>
     <em>待评价订单</em>
    </a>
   </dd>
   <dd>
    <a href="#">
     <strong>2</strong>
     <em>退换货订单</em>
    </a>
   </dd>
  </dl>
 </div>
</section>
<!--footer-->
@include('layout.foot');
</body>
</html>
