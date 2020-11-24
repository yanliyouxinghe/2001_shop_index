<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>注册-联盟平台</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="static/images/icon/favicon.ico" type="static/image/x-icon">
<link rel="stylesheet" type="text/css" href="static/css/style.css" /><script src="static/js/html5.js"></script>
<script src="static/js/jquery.js"></script>
</head>
<body>
<div class="unionLoginTop">
 <div class="wrap">
  <h1>服装商城网上联盟平台</h1>
 </div>
</div>
<div class="unionLoginBg">
 <div class="wrap" style="background:url(static/images/unbg.jpg) center no-repeat;height:486px;">
  <dl class="loginForm">
   <dt>注册联盟平台</dt>   
   <dd>
    <span>账号：</span>
    <input type="text" name="user_plone" placeholder="输入账号" class="txtbox"/>
   </dd>
   <dd>
    <span>手机验证码：</span>
    <button type="button" id="aaa" value="获取手机校验码" class="get_num_btn"/>获取手机校验码</button>
   </dd>
    <dd>
    <span>手机校验码：</span>
     <input type="text" class="textbox" name="code" placeholder="手机校验码"/>
   </dd>
   <dd>
    <span>密码：</span>
    <input type="text" name="user_pwd" placeholder="输入密码" class="txtbox"/>
   </dd>
   <dd>
    <span>确认密码：</span>
    <input type="text" name="user_pwds" placeholder="输入密码" class="txtbox"/>
   </dd>
   <dd>
    <input type="button" value="立 即 注 册" class="loginBtn"/>
   </dd>
   <dd>
    <a href="{{url('/business')}}" title="登录账号" class="fl">已有账号，立即登录？</a>
    <a href="#" class="fr">忘记密码？</a>
   </dd>
  </dl>
 </div>
</div>
<!--footer-->
@include('layout.foot')
</body>
</html>
<script src="static/js/jquery.js"></script>
<script>
  $('.loginBtn').on('click',function(){
    var user_plone = $('input[name="user_plone"]').val();
      var user_pwd = $('input[name="user_pwd"]').val();
      var user_pwds = $('input[name="user_pwds"]').val();
      var code = $('input[name="code"]').val();
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
     
  })




</script>
