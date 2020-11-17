<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>注册</title>
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
 
<section class="wrap user_form">
 <div class="lt_img">
  <img src="static/images/form_bg.jpg"/>
 </div>
 <div class="rt_form">
  <h2>会员注册</h2>
  <ul>
   <li class="user_icon">
    <input type="text" class="textbox" placeholder="手机号码"/>
   </li>
   <li class="link_li">
    <input type="button" value="获取手机校验码" class="get_num_btn"/>
   </li>
   <li class="user_cc">
    <input type="text" class="textbox" placeholder="手机校验码"/>
   </li>
   <li class="user_pwd">
    <input type="password" class="textbox" placeholder="设置密码"/>
   </li>
   <li class="user_pwd">
    <input type="password" class="textbox" placeholder="确认密码"/>
   </li>
   <li class="link_li">
    <label><input type="checkbox"/><a>阅读注册协议</a></label>
    <a href="login.html" title="登录账号" class="fr">已有账号，立即登录？</a>
   </li>
   <li class="link_li">
    <input type="button" value="立即注册" class="sbmt_btn"/>
   </li>
  </ul>
 </div>
</section>
<!--footer-->
@include('layout.foot');
</body>
</html>
