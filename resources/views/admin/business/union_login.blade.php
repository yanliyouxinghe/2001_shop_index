<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>登录-联盟平台</title>
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
   <dt>登录联盟平台</dt>
   <dd>
    <span>账号：</span>
    <input type="text" placeholder="输入账号" class="txtbox"/>
   </dd>
   <dd>
    <span>密码：</span>
    <input type="text" placeholder="输入密码" class="txtbox"/>
   </dd>
   <dd>
    <input type="button" value="立 即 登 陆" class="loginBtn"/>
   </dd>
   <dd>
    <a href="{{url('reg')}}" class="fl">新用户注册</a>
    <a href="#" class="fr">忘记密码？</a>
   </dd>
  </dl>
 </div>
</div>
<!--footer-->
@include('layout.foot')
</body>
</html>
