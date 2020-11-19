<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>产品列表</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="/jyl/images/icon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/jyl/css/style.css" /><script src="/jyl/js/html5.js"></script>
<script src="/jyl/js/jquery.js"></script>
<script>
$(document).ready(function(){
  $("nav .indexAsideNav").hide();
  $("nav .category").mouseover(function(){
	  $(".asideNav").slideDown();
	  });
  $("nav .asideNav").mouseleave(function(){
	  $(".asideNav").slideUp();
	  });
  //冒泡
  $(".favorite_list li a").click(function(){
	alert("链接");
	window.location.href='shop.html';
	});
	$(".favorite_list li .shop_collect_goods").click(function(){
	alert("收藏本店铺");
	event.stopPropagation();
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
    document.oncontextmenu=new Function("event.returnValue=false;");
    document.onselectstart=new Function("event.returnValue=false;"); 
  </script>
  
<section class="wrap list_class_page">
 <div class="lt_area">
   <div class="attr_filter">
      <h2>属性筛选</h2>
      <ul>
         <li>
         <dl>
         <dt>按品牌筛选：</dt>
            @foreach($brandInfo as $v)
         <dd>
               <a >{{$v['brand_name']}}</a>
         </dd>
         @endforeach
         </dl>
         
         </li>
         <li class="search">
         <dl >
         <dt>按价格筛选：</dt>
            @foreach($priceInfo as $v)
            <dd field="shop_price" value="{{$v}}">
               <a class="redhover">{{$v}}</a>      
            </dd>
         @endforeach
         </dl>
         </li>
         <li>
         <dl>
         <dt>按上架时间筛选：</dt>
         <dd>
            <a>今天</a>
            <a>昨天</a>
            <a>本周</a>
            <a>本月</a>
         </dd>
         </dl>
         </li>
      </ul>
   </div>
   <!--产品列表-->
    <section class="shop_li">
     <h2>商品列表</h2>
      <ul class="favorite_list">
       @foreach($goodsInfo as $v)
       <li>
          <a>{{$v['goods_name']}}</a>
       </li>
       @endforeach
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
    </section>

 </div>

 <aside class="rtWrap">
  <dl class="rtLiTwoCol">
      <dt>热门推荐</dt>
      <dd>
      <a href="product.html">
      <img src="/jyl/upload/goods002.jpg"/>
      <p>0.00</p>
      </a>
      </dd>
      <dd>
      <a href="product.html">
      <img src="/jyl/upload/goods001.jpg"/>
      <p>0.00</p>
      </a>
      </dd>
      <dd>
      <a href="product.html">
      <img src="/jyl/upload/goods003.jpg"/>
      <p>0.00</p>
      </a>
      </dd>
  </dl>
 </aside>
</section>
<!--footer-->
@include('layout.foot')
</body>
<script>

</script>
</html>
