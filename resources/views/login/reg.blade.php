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
    <input type="text" class="textbox" name="user_plone" placeholder="手机号码"/>
   </li>
   <li class="link_li">
    <button type="button" id="aaa" value="获取手机校验码" class="get_num_btn"/>获取手机校验码</button>
   </li>
   <li class="user_cc">
    <input type="text" class="textbox" name="code" placeholder="手机校验码"/>
   </li>
   <li class="user_pwd">
    <input type="password" class="textbox" name="user_pwd" placeholder="设置密码"/>
   </li>
   <li class="user_pwd">
    <input type="password" class="textbox" name="user_pwds" placeholder="确认密码"/>
   </li>
   <li class="link_li">
    <a href="{{url('/login')}}" title="登录账号" class="fr">已有账号，立即登录？</a>
   </li>
   <li class="link_li">
    <input type="button" id="aww" value="立即注册" class="sbmt_btn"/>
   </li>
  </ul>
 </div>
</section>
<!--footer-->
@include('layout.foot');
</body>
</html>
<script src="/static/js/jquery.js"></script>
<script>
    $(document).on('click','#aww',function(){
      var user_plone = $('input[name="user_plone"]').val();
      var user_pwd = $('input[name="user_pwd"]').val();
      var user_pwds = $('input[name="user_pwds"]').val();
      var code = $('input[name="code"]').val();
            // alert(code);
      $.post('http://2001.shop.api.com/regdo',{user_plone:user_plone,user_pwd:user_pwd,user_pwds:user_pwds,code:code},function (result) {
            if(result.code=='00001'){
                alert(result.msg);
            }
            if(result.code=='00002'){
                alert(result.msg);
            }
            if(result.code=='00003'){
                alert(result.msg);
            }
            if(result.code=='00004'){
                alert(result.msg);
            }
            if(result.code=='00000'){
                location.href = "/login"
            }else{
                alert(result.msg);
            }
        },'json')
    });
    $('button').click(function () {
        var count = 60; //间隔函数，1秒执行
        var InterValObj1; //timer变量，控制时间
        var count1; //当前剩余秒数
          // alert(111);
            count1=count; 		 
          
            // 设置button效果，开始计时
            $("#aaa").attr("disabled", "true");
            $("#aaa").val( + count1 + "秒再获取");
            InterValObj1=window.setInterval(SetRemainTime1,1000); //启动计时器，1秒执行一次
            // 向后台发送处理数据
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            }); 


              function SetRemainTime1(){
                if (count1 == 0) {                
                  window.clearInterval(InterValObj1);//停止计时器
                  $("#aaa").removeAttr("disabled");//启用按钮
                  $("#aaa").val("重新发送");
                }else{
                  count1--;
                  $("#aaa").val( + count1 + "秒再获取");
                }
		          }





        var name = $('input[name="user_plone"]').val();
        // alert(name);
        var mobilereg = /^1[3|5|6|7|8|9]\d{9}$/;
        if(mobilereg.test(name)){
            //发送手机号验证码
            $.get('http://2001.shop.api.com/sendSMS',{name:name},function (res) {
                if(res.code=='00001'){
                    alert(res.msg);
                }
                if(res.code=='00000'){
                    alert(res.msg);
                }
                if(res.code=='00002'){
                    alert(res.msg);
                }
            },'json');
            return;
        }
        alert('请输入正确的手机号');
        return;
    })





</script>
  