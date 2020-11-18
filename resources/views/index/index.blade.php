<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>首页</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="static/images/icon/favicon.ico" type="static/image/x-icon">
<link rel="stylesheet" type="text/css" href="static/css/style.css" /><script src="static/js/html5.js"></script>
<script src="static/js/jquery.js"></script>
<script src="static/js/swiper.min.js"></script>
<script>
$(document).ready(function(){
	//焦点图
	var mySwiper = new Swiper('#slide',{
		  autoplay:5000,
		  visibilityFullFit : true,
		  loop:true,
		  pagination : '.pagination',
	  });
})
</script>
</head>
<body>
<!--advertisment<div class="wrap"><img src="upload/banner.jpg"/></div>-->
<!--header-->
<!-- 头部 -->
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
 
<!--advertisment area-->
<section class="wrap">
 <!--ctCont-->
 <div class="IdxmainArea">
    <!--slide-->
    <div id="slide">
     <!-- 轮播图 -->
      <div class="swiper-wrapper">
        @foreach($slideshow as $k=>$v)
        <div class="swiper-slide">
         <a href="/goods/{{$v->goods_id}}">
          <img src="{{$v->goods_img}}"/>
         </a>
        </div>
        @endforeach
      </div>
     
      <div class="pagination"></div>  
    </div>

    <!--singleAd-->
    <div class="singleAd">
     <a href="#">
      <img src="static/upload/sigleAd.jpg"/>
     </a>
    </div>

    
     <!--bestShop-->
    <dl class="bestShop">
     <dt>
      <strong>优秀商家推荐</strong>
      <a href="shop_list.html" class="fr">更多</a>
     </dt>

    
     <dd>
      <a href="shop.html">
       <img src="static/upload/002.jpg"/>
       <h2>DM精品女装</h2>
      </a>
     </dd>
     <dd>
      <a href="shop.html">
       <img src="static/upload/003.jpg"/>
       <h2>DM精品女装</h2>
      </a>
     </dd>
     <dd>
      <a href="shop.html">
       <img src="static/upload/004.jpg"/>
       <h2>DM精品女装</h2>
      </a>
     </dd>
     <dd>
      <a href="shop.html">
       <img src="static/upload/005.jpg"/>
       <h2>DM精品女装</h2>
      </a>
     </dd>
     <dd>
      <a href="shop.html">
       <img src="static/upload/006.jpg"/>
       <h2>DM精品女装</h2>
      </a>
     </dd>
     <dd>
      <a href="shop.html">
       <img src="static/upload/007.jpg"/>
       <h2>DM精品女装</h2>
      </a>
     </dd>
     <dd>
      <a href="shop.html">
       <img src="static/upload/008.jpg"/>
       <h2>DM精品女装</h2>
      </a>
     </dd>
    </dl>
 </div>
 <!--asdCont-->
 <div class="IdxAsideRt">
  <!--login-->
  <div class="idxRtLogin">
   <div class="fstArea">
     <a href="#" class="userIcon">
      <img src="static/images/icon/DefaultAvatar.jpg">
     </a>
     <div class="rtInfor">
      <p>Hi!你好</p>
      <p class="obviousText">免费入驻，提升品牌效应！</p>
     </div>
    </div>
    <div class="secArea">
     <a href="login.html">登录</a>
     <a href="register.html">免费注册</a>
     <a href="register.html">商户入驻</a>
    </div>
   </div>
   <dl class="idxRtAtc">
    <dt>
     <em class="obviousText">最新公告</em>
     <a href="article_list.html">more</a>
    </dt>
    <dd><a href="article_read.html">2015年12月20日系统升级通告统升级通告</a></dd>
    <dd><a href="article_read.html">2015年12月20日系统升级通告</a></dd>
    <dd><a href="article_read.html">2015年12月20日系统升级通告</a></dd>
    <dd><a href="article_read.html">2015年12月20日系统升级通告</a></dd>
    <dd><a href="article_read.html">2015年12月20日系统升级通告</a></dd>
   </dl>
   <dl class="idxRtAtc">
    <dt>
     <em>质量标准技术参数</em>
     <a href="article_list.html">more</a>
    </dt>
    <dd><a href="article_read.html">2015年12月20日系统升级通告统升级通告</a></dd>
    <dd><a href="article_read.html">2015年12月20日系统升级通告</a></dd>
   </dl>
  </div>
</section>
<!--productList-->
<section class="wrap idxproLi">
 <h2>
  <strong>
   <a href="channel.html">产品展示区</a>
  </strong>
  <span class="classLi">
   <a href="product_list.html">夏装</a>
   <a href="product_list.html">连衣裙</a>
   <a href="product_list.html">开衫</a>
   <a href="product_list.html">牛仔裤</a>
   <a href="product_list.html">背带裤</a>
   <a href="product_list.html">T恤</a>
  </span>
 </h2>
 <div class="ltArea">
  <!--ad:category pic-->
   <a href="https://www.taobao.com/">
   <script src="/static/ads/1.js"></script>
   </a>
 </div>
 <div class="ctLi">
  <ul>
   <li>
    <a href="https://www.jd.com/">
     <h3>2020时尚新款</h3>
     <script src="/static/ads/2.js"></script>
     <p><span>350.00</span></p>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
     <h3>2020时尚新款</h3>
     <script src="/static/ads/3.js"></script>
     <p><span>450.00</span></p>
    </a>
   </li>
   <li>
    <a href="https://www.jd.com/">
    <script src="/static/ads/4.js"></script>
     <h3>2020时尚新款</h3>
     <p><span>1000.00</span></p>
    </a>
   </li>
   <li>
    <a href="https://www.taobao.com/">
    <script src="/static/ads/5.js"></script>
     <h3>2020时尚新款</h3>
     <p><span>1200.00</span></p>
    </a>
   </li>
   <li>
    <a href="https://www.taobao.com/">
    <script src="/static/ads/6.js"></script>
     <h3>2020时尚新款</h3>
     <p><span>980.00</span></p>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
    <script src="/static/ads/7.js"></script>
     <h3>2020时尚新款</h3>
     <p><span>1300.00</span></p>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
    <script src="/static/ads/8.js"></script>
     <h3>2020时尚新款</h3>
     <p><span>1400.00</span></p>
    </a>
   </li>
   <li>
    <a href="https://www.jd.com/">
    <script src="/static/ads/9.js"></script>
     <h3>2020时尚新款</h3>
     <p><span>1400.00</span></p>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
    <script src="/static/ads/10.js"></script>
     <h3>2020时尚新款</h3>
     <p><span>1400.00</span></p>
    </a>
   </li>
   <li>
   <a href="https://www.jd.com/">
    <script src="/static/ads/11.js"></script>
     <h3>2020时尚新款</h3>
     <p><span>1400.00</span></p>
    </a>
   </li>
  </ul>
  <!--bestBrand-->
  <div class="idxBrandLi">
   <a href="https://www.jd.com/"><script src="/static/ads/12.js"></script></a>
   <a href="https://www.taobao.com/"><script src="/static/ads/13.js"></script></a>
   <a href="https://www.jd.com/"><script src="/static/ads/14.js"></script></a>
   <a href="https://www.taobao.com/"><script src="/static/ads/15.js"></script></a>
  </div>
 </div>
</section>

<section class="wrap idxproLi">
 <h2>
  <strong>
   <a href="channel.html">设备展示区</a>
  </strong>
  <span class="classLi">
   <a href="product_list.html">夏装</a>
   <a href="product_list.html">连衣裙</a>
   <a href="product_list.html">开衫</a>
   <a href="product_list.html">牛仔裤</a>
   <a href="product_list.html">背带裤</a>
   <a href="product_list.html">T恤</a>
  </span>
 </h2>
 <div class="ltArea">
  <!--ad:category pic-->
   <a href="product_list.html"><img src="static/upload/bestCategoryPic02.jpg"/></a>
 </div>
 <div class="ctLi">
  <ul>
   <li>
    <a href="product.html">
     <img src="static/upload/goods005.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>1000.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods006.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>545.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods007.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>1000.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods008.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>1000.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods009.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>980.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods010.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>642.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods005.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>793.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods006.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>755.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods007.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>360.00</span></p>
    </a>
   </li>
   <li>
    <a href="product.html">
     <img src="static/upload/goods008.jpg"/>
     <h3>2019时尚新款</h3>
     <p><span>1255.00</span></p>
    </a>
   </li>
  </ul>
  <!--bestBrand-->
  <div class="idxBrandLi">
   <a href="shop.html"><img src="static/upload/brandLogo01.jpg"/></a>
   <a href="shop.html"><img src="static/upload/brandLogo02.jpg"/></a>
   <a href="shop.html"><img src="static/upload/brandLogo03.jpg"/></a>
   <a href="shop.html"><img src="static/upload/brandLogo04.jpg"/></a>
  </div>
 </div>
</section>
<!--case-->
<section class="wrap idexCase">
 <h2>
  <strong>工程案例</strong>
  <a href="#">more</a>
 </h2>
 <ul>
  <li>
   <a href="#">
    <img src="static/upload/case001.jpg"/>
    <h3>时尚搭配案例</h3>
   </a>
  </li>
  <li>
   <a href="#">
    <img src="static/upload/case002.jpg"/>
    <h3>时尚搭配案例</h3>
   </a>
  </li>
  <li>
   <a href="#">
    <img src="static/upload/case003.jpg"/>
    <h3>时尚搭配案例</h3>
   </a>
  </li>
  <li>
   <a href="#">
    <img src="static/upload/case004.jpg"/>
    <h3>时尚搭配案例</h3>
   </a>
  </li>
  <li>
   <a href="#">
    <img src="static/upload/case005.jpg"/>
    <h3>时尚搭配案例</h3>
   </a>
  </li>
 </ul>
</section>
<!--section:two->articleList-->
<section class="wrap idxArticle">
  <dl>
   <dt>
    <strong>招标资讯</strong>
    <a href="article_list.html">more</a>
   </dt>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
   <dd><a href="article_read.html">四川省老年大学教学用具及设备采购二标段公开招标采购公告</a></dd>
   <dd><a href="article_read.html">慢道峰山桥至仙境源风机路、曲径通幽至老虎洞至孙家至王沟服务区亮化工程公开招标公告</a></dd>
   <dd><a href="article_read.html">四川省资阳市安岳县民政局第二次全国地名普查外包服务采购项目公开招标采购公告</a></dd>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
  </dl>
  <dl style="margin:0 2.5%">
   <dt>
    <strong>最新询价信息</strong>
    <a href="article_list.html">more</a>
   </dt>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
   <dd><a href="article_read.html">四川省老年大学教学用具及设备采购二标段公开招标采购公告</a></dd>
   <dd><a href="article_read.html">慢道峰山桥至仙境源风机路、曲径通幽至老虎洞至孙家至王沟服务区亮化工程公开招标公告</a></dd>
   <dd><a href="article_read.html">四川省资阳市安岳县民政局第二次全国地名普查外包服务采购项目公开招标采购公告</a></dd>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
  </dl>
  <dl>
   <dt>
    <strong>行业资讯</strong>
    <a href="article_list.html">more</a>
   </dt>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
   <dd><a href="article_read.html">四川省老年大学教学用具及设备采购二标段公开招标采购公告</a></dd>
   <dd><a href="article_read.html">慢道峰山桥至仙境源风机路、曲径通幽至老虎洞至孙家至王沟服务区亮化工程公开招标公告</a></dd>
   <dd><a href="article_read.html">四川省资阳市安岳县民政局第二次全国地名普查外包服务采购项目公开招标采购公告</a></dd>
   <dd><a href="article_read.html">内蒙古君联生物发展有限公司阿巴嘎旗流化床锅炉除尘及链条炉排炉内脱硫设施采购项目公开招标招标公告</a></dd>
  </dl>
 </section>
<!--footer-->
  <!-- 尾部 -->
   @include('layout.foot')
</body>
</html>
