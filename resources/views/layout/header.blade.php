<header>
  <!--topNavBg-->
  <div class="topNavBg">
   <div class="wrap">
   <!--topLeftNav-->
    <ul class="topLtNav">
     <li><a href="{{url('/login')}}" class="obviousText">亲，请登录</a></li>
     <li><a href="{{url('/reg')}}">注册</a></li>
     <li><a href="#">移动端</a></li>
    </ul>
   <!--topRightNav-->
    <ul class="topRtNav">
     <li><a href="{{url('/ser')}}">个人中心</a></li>
     <li><a href="{{url('/cart')}}" class="cartIcon">购物车<i>{{request()->count_cart['data']}}</i></a></li>
     <li><a href="{{'favo'}}" class="favorIcon">收藏夹</a></li>
     <li><a href="{{url('/ser')}}">商家中心</a></li>
     <li><a href="union_login.html">联盟管理</a></li>
    </ul>
   </div>
  </div>
  <!--logoArea-->
  <div class="wrap logoSearch">
   <!--logo-->
   <div class="logo">
    <h1><img src="static/images/logo.png"/></h1>
   </div>
   <!--search-->
   <div class="search">
    <ul class="switchNav">
     <li class="active" id="chanpin">产品</li>
     <li id="shangjia">商家</li>
     <li id="zixun">搭配</li>
     <li id="wenku">文库</li>
    </ul>
    <div class="searchBox">
     <form>
      <div class="inputWrap">
      <input type="text" placeholder="输入产品关键词或货号"/>
      </div>
      <div class="btnWrap">
      <input type="submit" value="搜索"/>
      </div>
     </form>
     <a href="#" class="advancedSearch">高级搜索</a>
    </div>
   </div>
  </div>
  <!--nav-->
  
  <nav>
    <ul class="wrap navList">
     <li class="category">
      <a>全部产品分类</a>
      <dl class="asideNav indexAsideNav">
      @foreach(request()->cartgoryInfo as $v)
      <dt><a href="{{url('list/'.$v['cat_id'])}}">{{$v['cat_name']}}</a></dt>
        <dd>
          @foreach($v['child'] as $vv)
          <a href="{{url('list/'.$vv['cat_id'])}}">{{$vv['cat_name']}}</a>
          @endforeach
        </dd>
        @endforeach
      </dl>
      </li>

      <li>
          <a href="index.html" class="active">首页</a>
          </li>
          <li>
          <a href="#">时尚搭配</a>
          </li>
          <li>
          <a href="channel.html">原创设计</a>
          </li>
          <li>
          <a href="channel.html">时尚代购</a>
          </li>
          <li>
          <a href="channel.html">民族风</a>
          </li>
          <li>
          <a href="information.html">时尚搭配</a>
          </li>
          <li>
          <a href="library.html">搭配知识</a>
          </li>
          <li>
          <a href="#">促销专区</a>
          </li>
          <li>
          <a href="#">其他</a>
          </li>
      </ul>
  </nav>

 </header>