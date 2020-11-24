<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>确认订单</title>
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



<section class="wrap" style="margin-top:20px;overflow:hidden;">
<!-- 收货人信息 -->
 <table class="order_table address_tbl">
   <tr>
    <th width="200">收件人</th>
    <th width="200">联系电话</th>
    <th width="200">收件地址</th>
    <th width="200">操作</th>
   </tr>
   @if($addressinfo)
   @foreach($addressinfo as $vv)
   @foreach($vv as $v)
   <tr @if($v['is_default']) selected @endif address_id="{{$v['address_id']}}">
    <td>{{$v['consignee']}}</td>
    <td>{{$v['tel']}}</td>
    <td>
     <address>
      {{$v['country_name']}}{{$v['province_name']}}{{$v['city_name']}}{{$v['district_name']}}
     </address>
    </td>
    <td>
     <label>
        @if($v['is_default'])
        <input type="radio" name="moren" checked/>设为默认地址
        @endif
     </label>
     <input type="button" value="编辑" class="btn"/>
     <!-- <input type="button" value="删除" class="del" address_id="{{$v['address_id']}}"/> -->
     <a href="javascript:void(0)" class="del"  address_id="{{$v['address_id']}}">删除</a>
    </td>
   </tr>
   @endforeach
   @endforeach
   @endif
</table>

<table class="order_table">
  <caption>
   <strong>订单商品</strong>
   <a href="cart.html">返回购物车修改</a>
  </caption>
  <tbody><tr>
   <td class="center"><a href="product.html"><img src="upload/goods.jpg" style="width:50px;height:50px;"></a></td>
   <td><a href="product.html">这里是产品名称</a></td>
   <td>
    <p>颜色：黑色</p>
    
    <p>规格：M码</p>
   </td>
   <td class="center"><span class="rmb_icon">15.88</span></td>
   <td class="center"><span>1</span></td>
   <td class="center"><strong class="rmb_icon">15.88</strong></td>
  </tr>
  <tr>
   <td class="center"><a href="product.html"><img src="upload/goods007.jpg" style="width:50px;height:50px;"></a></td>
   <td style="width:200px;"><a href="product.html">这里是产品名称</a></td>
   <td>
    <p>颜色：黑色</p>
    
    <p>规格：M码</p>
   </td>
   <td class="center"><span class="rmb_icon">15.88</span></td>
   <td class="center"><span>1</span></td>
   <td class="center"><strong class="rmb_icon">15.88</strong></td>
  </tr>
  <tr>
   <td class="center"><a href="product.html"><img src="upload/goods008.jpg" style="width:50px;height:50px;"></a></td>
   <td style="width:200px;"><a href="product.html">这里是产品名称</a></td>
   <td>
    <p>颜色：黑色</p>
    
    <p>规格：M码</p>
   </td>
   <td class="center"><span class="rmb_icon">15.88</span></td>
   <td class="center"><span>1</span></td>
   <td class="center"><strong class="rmb_icon">15.88</strong></td>
  </tr>
 </tbody></table>


 <!--支付与配送-->
 <ul class="order_choice">
  <li>
   <dl>
    <dt>支付方式</dt>
   <!-- istrue -->
    <dd class="payType">
      <label class="radio istrue" pay_type="1"><input type="radio" name="pay"/>支付宝</label>
      <label class="radio" pay_type="2" ><input type="radio" name="pay"/>微信支付</label>
      <label class="radio" pay_type="3"><input type="radio" name="pay"/>货到付款</label>
      <label class="radio" pay_type="4"><input type="radio" name="pay"/>余额支付</label>
    </dd>

   </dl>
  </li>
  <li>
   <dl>
    <dt>配送方式</dt>
    <dd>
     <label class="radio istrue"><input type="radio" name="peisong"/>快递</label>
     <label class="radio"><input type="radio" name="peisong"/>自配送</label>
     <label class="radio"><input type="radio" name="peisong"/>物流</label>

    </dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>订单留言</dt>
    <dd>
     <textarea></textarea>
    </dd>
   </dl>
  </li>
 </ul>
 <div class="order_btm_btn">
  <a href="system_prompts.html" class="link_btn_02 add_btn"/>共计金额<strong class="rmb_icon">0.00</strong>提交订单</a>
 </div>
</section>
<!--footer-->
@include('layout.foot')
</body>
<script scr="/static/jyl/js/jquery.js"></script>
<script>
  //ajax删除
  $(document).on('click','.del',function(){
    var _this = $(this);
    // var address_id = [];
    var address_id = _this.attr('address_id');
    if(!address_id){
      return;
    }

    if(confirm("您确定要删除吗?")){
      $.post('/address_del',{address_id:address_id},function(res){
        if(res.code==0){
          _this.parent().parent().remove();
        }else{
          alert(res.msg);
        }
      },'json')

    }
    return false;


  })

  //支付方式默认选中和配送方式默认选中 和 特效
  $(document).on('click','.radio',function(){
    var _this = $(this);
    _this.siblings().removeClass('istrue');
    _this.addClass('istrue');
  })







  		

  
  

</script>
</html>
