<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>修改密码-用户中心</title>
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
   <strong>修改密码</strong>
  </div>
  <table class="order_table">
   <tr>
    <td width="80" align="right">原始密码：</td>
    <td><input type="password" class="textbox"/><mark class="tips_errors">这里是提示性或错误信息</mark></td>
   </tr>
   <tr>
    <td width="80" align="right">设置新密码：</td>
    <td><input type="password" class="textbox"/><mark class="tips_errors">这里是提示性或错误信息</mark></td>
   </tr>
   <tr>
    <td width="80" align="right">确认新密码：</td>
    <td><input type="password" class="textbox"/><mark class="tips_errors">这里是提示性或错误信息</mark></td>
   </tr>
   <tr>
    <td width="80" align="right"></td>
    <td><input type="button" class=" group_btn" value="修改密码"/></td>
   </tr>
  </table>
 </div>
</section>
<!--footer-->
@include('layout.foot')
</body>
</html>
