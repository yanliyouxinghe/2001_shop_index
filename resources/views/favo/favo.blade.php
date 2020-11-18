<!DOCTYPE html>
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

  <!--topNavBg-->
 
   <!--topLeftNav-->
   @include('layout.header')
   <!--topRightNav-->
 
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
   <!-- //左侧导航 -->
   @include('layout.myorder')
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
