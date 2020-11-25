<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>产品详情</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="/jyl/images/icon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/jyl/css/style.css" /><script src="/jyl/js/html5.js"></script>
<script src="/jyl/js/jquery.js"></script>
<script src="/jyl/js/jquery.jqzoom.js"></script>
<script src="/jyl/js/base.js"></script>
<script>
$(document).ready(function(){
  $("nav .indexAsideNav").hide();
  $("nav .category").mouseover(function(){
	  $(".asideNav").slideDown();
	  });
  $("nav .asideNav").mouseleave(function(){
	  $(".asideNav").slideUp();
	  });
  //detail tab
  $(".product_detail_btm .item_tab a").click(function(){
	   var liindex = $(".product_detail_btm .item_tab a").index(this);
	   $(this).addClass("curr_li").parent().siblings().find("a").removeClass("curr_li");
       $(".cont_wrap").eq(liindex).fadeIn(150).siblings(".cont_wrap").hide();
	  });
  //radio
  $(".horizontal_attr label").click(function(){
	  $(this).addClass("isTrue").siblings().removeClass("isTrue");
    
    });
    




     $('label').click(function(){
          var goods_attr_id = getattrid();
          getattrprice(goods_attr_id);
   })

  $(function(){
    var goods_attr_id = getattrid();
          getattrprice(goods_attr_id);
  });

    function getattrid(){
      var goods_attr_id = new Array();
              $('label.isTrue').each(function(i){
                goods_attr_id.push($(this).attr('goods_attr_id'));
              });
              return goods_attr_id;
    }
    function getattrprice(goods_attr_id){
      if(goods_attr_id.length > 0){
                var goods_id ="{{$goodsinfo[0]['goods_id']}}";
                $.get('/getattrprice',{'goods_attr_id':goods_attr_id,'goods_id':goods_id},function(res){
                  $('.rmb_icon').text(res.data);
                },'json');
              }else{
                return false;
          }
    }
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
 
 <!--导航指向-->
<aside class="wrap insideLink">
  <a href="index.html">首页</a>
  <a href="product_list.html">时尚女装</a>
</aside>
<section class="wrap product_detail">
 <!--img:left-->
 @foreach($goodsinfo as $v)
 <div class="gallery">
  <div>
    <div id="preview" class="spec-preview"> <span class="jqzoom"><img jqimg="{{$v['goods_img']}}" src="{{$v['goods_img']}}" width="440px";height="5500px"; /></span> </div>
    <!--缩图开始-->
    <div class="spec-scroll"> <a class="prev">&lt;</a> <a class="next">&gt;</a>
      <div class="items">
        <ul>
          <li><img bimg="/{{$v['goods_img']}}" src="{{$v['goods_img']}}" onmousemove="preview(this);"></li>
        </ul>
      </div>


    </div>
    <!--缩图结束-->
  </div>
 </div>

 
 <div class="rt_infor">
  <!--lt_infor-->
  <!--个人收藏  -->
        <ul>
           <li><a href="javascript:void(0)" class="favorIcon" goods_id="{{$v['goods_id']}}">收藏宝贝</a></li>
        </ul>
  <div class="goods_infor">
   <h2>{{$v['goods_name']}}</h2>
   <ul>
    <li>
     <dl class="horizontal">
      <dt>价格：</dt>
      <dd><strong class="rmb_icon univalent">{{$v['shop_price']}}</strong></dd>
     </dl>
    </li>
    <li>
     <dl class="horizontal">
      <dt>品牌：</dt>
      <dd><em><time>{{$v['brand_name']}}</time></em>
     </dl>
    </li>
    <li class="statistics">
     <dl class="vertical">
      <dt>月销量</dt>
      <dd>20</dd>
     </dl>
     <dl class="vertical">
      <dt>累计评论</dt>
      <dd>198</dd>
     </dl>
     <dl class="vertical">
      <dt>关注</dt>
      <dd>230</dd>
     </dl>
    </li>
    <li>
    @foreach($attr as $kk => $vv)
     <dl class="horizontal horizontal_attr">
      <dt>{{$vv['attr_name']}}</dt>      
      <dd>
     @php $i=0; @endphp
      @foreach($vv['attr_value'] as $kkk => $vvv)
       <label  @if($i==0) class="isTrue" @endif  goods_attr_id="{{$kkk}}">{{$vvv}}</label>
       @php $i++;@endphp
      @endforeach
     
      </dd>
     </dl>
     @endforeach
    <li>
     <dl class="horizontal horizontal_attr">
      <dt>数量：</dt>
      <dd>
       <input type="button" value="-" class="jj_btn mins"/>
       <input type="text" value="1" readonly class="num buy_number"/>
       <input type="button" value="+" class="jj_btn plus"/>
       <span>库存：{{$v['goods_number']}}件</span>
      </dd>
     </dl>
    </li>
    <li class="last_li">
       <input type="button" value="立即询价" class="buy_btn" onClick="alert('询价请求已推送至商家，请耐心等待！');"/>
       <input type="button" value="立即购买" class="buy_btn" onClick="javascript:location.href='cart.html'"/>
       <input type="button" value="加入购物车" class="add_btn  add"/>
    </li>
   </ul>
  </div>

  <!--rt_infor-->
 </div>
</section>
<!--detail-->



<section class="wrap product_detail_btm">
 <article>
  <ul class="item_tab">
   <li><a class="curr_li">商品详情</a></li>
   <li><a>商品评价（2893）</a></li>
   <li><a>成交记录（1892）</a></li>
  </ul>
  <!--商品详情-->


  <div class="cont_wrap active">
{!! $v['goods_desc'] !!}
  </div>
  @endforeach
  <!--商品评价-->
  <div class="cont_wrap">
   <table class="table">
    <tr>
     <td width="20%" align="center">李*锋</td>
     <td width="60%">这里是评论内容哦这里是评论内容哦这里是评论内容哦这里是评论内容哦这里是评论内容哦这里是评论内容哦这里是评论内容哦这里是评论内容哦这里是评论内容哦</td>
     <td width="20%" align="center"><time>2013-01-13 15:06</time></td>
    </tr>
   
   </table>
   
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
  <!--成交记录-->
  <div class="cont_wrap">
   <table class="table">
    <tr>
     <th>买家</th>
     <th>产品属性</th>
     <th>数量</th>
     <th>成交时间</th>
    </tr>
    <tr>
     <td align="center">李**强</td>
     <td>
      <p>颜色：黑色<p>
      <p>规格：M<p>
     </td>
     <td align="center"><b>1</b></td>
     <td align="center"><time>2013-01-13 15:25:39</time></td>
    </tr>
   </table>
  
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
 </article>
 <aside>
  <dl class="aside_pro_list">
   <dt>
    <strong>精品推荐</strong>
    <a>更多</a>
   </dt>
   @foreach($recommended as $vv)
   <dd>
    <a href="{{$vv['goods_id']}}" class="goods_img"><img src="{{$vv['goods_img']}}"/></a>
    <div class="rt_infor">
     <h3><a href="{{$vv['goods_id']}}">{{$vv['goods_name']}}</a></h3>
     <p><del class="rmb_icon">{{$vv['shop_price']}}+300/del></p>
     <p><strong class="rmb_icon">{{$vv['shop_price']}}</strong></p>
    </div>
    @endforeach
   </dd>
  </dl>
 </aside>
</section>
<!--footer-->
<footer>
 <!--help-->
 <ul class="wrap help">
  <li>
   <dl>
    <dt>消费者保障</dt>
    <dd><a href="article_read.html">保障范围</a></dd>
    <dd><a href="article_read.html">退换货流程</a></dd>
    <dd><a href="article_read.html">服务中心</a></dd>
    <dd><a href="article_read.html">更多服务特色</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>新手上路</dt>
    <dd><a href="article_read.html">保障范围</a></dd>
    <dd><a href="article_read.html">退换货流程</a></dd>
    <dd><a href="article_read.html">服务中心</a></dd>
    <dd><a href="article_read.html">更多服务特色</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>付款方式</dt>
    <dd><a href="article_read.html">保障范围</a></dd>
    <dd><a href="article_read.html">退换货流程</a></dd>
    <dd><a href="article_read.html">服务中心</a></dd>
    <dd><a href="article_read.html">更多服务特色</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>服务保障</dt>
    <dd><a href="article_read.html">保障范围</a></dd>
    <dd><a href="article_read.html">退换货流程</a></dd>
    <dd><a href="article_read.html">服务中心</a></dd>
    <dd><a href="article_read.html">更多服务特色</a></dd>
   </dl>
  </li>
 </ul>
 <dl class="wrap otherLink">
  <dt>友情链接</dt>
  <dd><a href="#" target="_blank">素材网站</a></dd>
  <dd><a href="#/pins/24448.html">HTML5模块化后台管理模板</a></dd>
  <dd><a href="#/pins/15966.html">绿色清爽后台管理系统模板</a></dd>
  <dd><a href="#/pins/14931.html">黑色的cms商城网站后台管理模板</a></dd>
  <dd><a href="http://www.bootstrapmb.com" target="_blank">前端博客</a></dd>
  <dd><a href="http://www.bootstrapmb.com" target="_blank">博客</a></dd>
  <dd><a href="http://www.bootstrapmb.com" target="_blank">新码笔记</a></dd>
  <dd><a href="http://www.bootstrapmb.com" target="_blank">DethGhost</a></dd>
  <dd><a href="#">当当</a></dd>
  <dd><a href="#">优酷</a></dd>
  <dd><a href="#">土豆</a></dd>
  <dd><a href="#">新浪</a></dd>
  <dd><a href="#">钉钉</a></dd>
  <dd><a href="#">支付宝</a></dd>
 </dl>
 <div class="wrap btmInfor">
  <p>© 2013 DeathGhost.cn 版权所有 网络文化经营许可证：浙网文[2013]***-027号 增值电信业务经营许可证：浙B2-200***24-1 信息网络传播视听节目许可证：1109***4号</p>
  <address>联系地址：陕西省西安市雁塔区XXX号</address>
 </div>
</footer>
</body>
</html>
<script src="/static/js/jquery.js"></script>
<script>
//个人收藏
$('.favorIcon').click(function(){
      var goods_id ="{{$goodsinfo[0]['goods_id']}}";
      
      $.ajax({
          type:'get',
          url: "http://2001.shop.api.com/createcollect",
          dataType:'json',
          data: {goods_id:goods_id},
          success: function(res){
             console.log(res);
            
          }
        });

    })




    $('label').click(function(){
          var goods_attr_id = getattrid();
          getattrprice(goods_attr_id);
   })

  $(function(){
    var goods_attr_id = getattrid();
          getattrprice(goods_attr_id);
  });

    function getattrid(){
      var goods_attr_id = new Array();
              $('label.isTrue').each(function(i){
                goods_attr_id.push($(this).attr('goods_attr_id'));
              });
              return goods_attr_id;
    }
    function getattrprice(goods_attr_id){
      if(goods_attr_id.length > 0){
                var goods_id ="{{$v['goods_id']}}";
                $.get('/getattrprice',{'goods_attr_id':goods_attr_id,'goods_id':goods_id},function(res){
                  $('.rmb_icon').text(res.data);
                },'json');
              }else{
                return false;
          }
    }
    $(function(){
  //+号
          $('.plus').click(function(){
            var num=$(this).prev().val();
            var num=parseInt(num)+1;
            var goods_number="{{$v['goods_number']}}";
            if(num>goods_number){
              alert('不能再多啦');
              return ;
            }else{
               $(this).prev().val(num);
            }
            // alert(num);
           
            
        })
        //-号
        $('.mins').click(function(){
            num=$(this).next().val();
            num=parseInt(num-1);
            if(num<1){
                alert('最小购买数量不能小于1');
            }else{
                $(this).next().val(num);
            }
        })
        $('.itxt').blur(function(){
            // alert(111);
            var num = $(this).val();
            // alert(num);
            if(num<1){
                alert('最小购买数量不能小于一');
                 num  = $(this).val('1');
            }
             var buy_number=$('.itxt').val();
            // alert(buy_number);
            if((buy_number<10)){
                alert('库存紧张');
            }
        })





    //加入购物车
    $('.add').click(function(){
         //商品id
         var goods_id = "{{$v['goods_id']}}";
        // alert(goods_id);
        //购买数量
        var buy_number = $('.buy_number').val();
        //  alert(buy_number);  
        var goods_attr_id = new Array();
    //属性id
        $('.isTrue').each(function(i){
         goods_attr_id.push($(this).attr('goods_attr_id'));
          });
          if(goods_attr_id==''){
             goods_attr_id = [];
          }
      //价格

      // alert(shop_price);    
          $.post('/addcart',{goods_id:goods_id,buy_number:buy_number,goods_attr_id:goods_attr_id},function(res){
			//未登录
            if(res.code=='1001'){
                alert(res.msg);
                location.href="/login?refer="+location.href;
            }
			//加入购物车成功
            if(res.code=='0'){
              location.href="/cart";
            }else{
               alert(res.msg);
            }

        },'json');
         
      })
    });



</script>

