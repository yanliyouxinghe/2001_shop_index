﻿<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>收藏-用户中心</title>
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
  //favorite nav
  $(".favorite_nav li").click(function(){
	   var liindex = $(".favorite_nav li").index(this);
	   $(this).addClass("curr_li").siblings().removeClass("curr_li");
       $(".favoriteWrap").eq(liindex).fadeIn(150).siblings(".favoriteWrap").hide();
	  });
  //冒泡
  $(".favorite_list li a").click(function(){
	alert("链接");
	window.location.href='product.html';
	});
	$(".favorite_list li .remove").click(function(){
	alert("移除");
	$(this).parents("li").remove();
	event.stopPropagation();
	});
});
</script>
</head>
<body>
<!--header-->
<header>
  <!--topNavBg-->
 
   <!--topLeftNav-->
   @include('layout.header')
   <!--topRightNav-->
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
 <!--左侧导航-->
  <aside class="user_aside_nav">
  <dl>
   <dt>买家中心</dt>
   <dd><a href="order_list.html">我的订单</a></dd>
   <dd><a href="price_list.html">我的询价单</a></dd>
   <dd><a href="favorite.html">我的收藏</a></dd>
   <dd><a href="address.html">我的地址库</a></dd>
  </dl>
  <dl>
   <dt>商家管理中心</dt>
   <dd><a href="authenticate.html">我要开店</a></dd>
   <dd><a href="setting.html">店铺设置</a></dd>
   <dd><a href="seller_product_list.html">商品列表</a></dd>
   <dd><a href="seller_order_list.html">订单列表</a></dd>
   <dd><a href="offer_list.html">询价单</a></dd>
  </dl>
  <dl>
   <dt>控制面板</dt>
   <dd><a href="message.html">站内短消息</a></dd>
   <dd><a href="account.html">资金管理</a></dd>
   <dd><a href="profile.html">个人资料</a></dd>
   <dd><a href="change_password.html">修改密码</a></dd>
  </dl>
 </aside>
 <!--右侧：内容区域-->
 <div class="user_rt_cont">
  <!--收藏类型导航-->
  <ul class="favorite_nav">
   <li class="curr_li">产品收藏</li>
   <li>店铺收藏</li>
  </ul>
  <div class="favoriteWrap" style="display:block;">
  <!--收藏列表-->
  <ul class="favorite_list">
   <li>
    <a>
     <img src="static/upload/goods005.jpg"/>
     <h2>2019时尚新款</h2>
     <p class="price"><span class="rmb_icon">298.00</span></p>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods010.jpg"/>
     <h2>2019时尚新款</h2>
     <p class="price"><span class="rmb_icon">298.00</span></p>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods009.jpg"/>
     <h2>2019时尚新款</h2>
     <p class="price"><span class="rmb_icon">298.00</span></p>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods008.jpg"/>
     <h2>2019时尚新款</h2>
     <p class="price"><span class="rmb_icon">298.00</span></p>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods006.jpg"/>
     <h2>2019时尚新款</h2>
     <p class="price"><span class="rmb_icon">298.00</span></p>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods004.jpg"/>
     <h2>2019时尚新款</h2>
     <p class="price"><span class="rmb_icon">298.00</span></p>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods003.jpg"/>
     <h2>2019时尚新款</h2>
     <p class="price"><span class="rmb_icon">298.00</span></p>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods002.jpg"/>
     <h2>2019时尚新款</h2>
     <p class="price"><span class="rmb_icon">298.00</span></p>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
  </ul>
   <!--分页-->
   <div class="paging">
    <a>第一页</a>
    <a class="active">2</a>
    <a>3</a>
    <a>...</a>
    <a>89</a>
    <a>最后一页</a>
   </div>
  </div>
  <!--店铺收藏-->
  <div class="favoriteWrap">
  <ul class="favorite_list">
   <li>
    <a>
     <img src="static/upload/goods006.jpg"/>
     <h2>店铺一</h2>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods004.jpg"/>
     <h2>店铺一</h2>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods003.jpg"/>
     <h2>店铺一</h2>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
   <li>
    <a>
     <img src="static/upload/goods002.jpg"/>
     <h2>店铺一</h2>
     <p class="remove"><span>&#126;</span></p>
    </a>
   </li>
  </ul>
   <!--分页-->
   <div class="paging">
    <a>第一页</a>
    <a class="active">2</a>
    <a>3</a>
    <a>...</a>
    <a>89</a>
    <a>最后一页</a>
   </div>
  </div>
 </div>
</section>
<!--footer-->
@include('layout.foot')
</body>
</html>
