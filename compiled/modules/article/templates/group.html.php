<?php
echo '<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=GBK" />
  <meta id="ctl00_metaKeywords" content="小说,小说网,言情小说,青春小说,玄幻小说,武侠小说,都市小说,历史小说,网络小说,原创网络文学"
  name="keywords">
  <meta id="ctl00_metaDescription" content="小说阅读,精彩小说尽在创酷中文网。创酷中文网提供玄幻小说,武侠小说,原创小说,网游小说,都市小说,言情小说,青春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说最新章节免费小说阅读,精彩尽在创酷中文网！热门小说:莽荒纪,绝世唐门,天骄无双,胜者为王,醉枕江山。"
  name="description">
  <!-- 360安全游览器使用webkit极速核 -->
  <meta name="renderer" content="webkit" />
  <meta name="description" content="创酷中文网网络各界小说高手,每日更新小说连载,小说排行榜更是提供全网最收欢迎的小说下载,当下最好看的小说,如言情小说.穿越小说.玄幻小说等.找最好看的免费小说就来创酷中文网."
  />
  <meta name="keywords" content="小说,小说排行榜,免费小说下载,好看的小说" />
  <!-- IE使用它支持的最高模式 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="baidu-site-verification" content="3R33MUNLCM" />
  <title>
    '.$this->_tpl_vars['groupname'].'小说阅读_创酷中文网|免费小说,玄幻小说,武侠小说,青春小说,小说网各类小说下载
  </title>
  <link href="/favicon.ico" type="image/x-icon"
  rel="shortcut icon">
  <link href="/favicon.ico" type="image/x-icon"
  rel="Bookmark">
  <link rel="stylesheet" type="text/css" href="/sink/css/base.css"
  />
 
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/jquery-1.7.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/common.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/theme.js"></script>
 <script type="text/javascript" src="/sink/js/base.js">
  </script>
  <script type="text/javascript" src="/sink/js/tcss.ping.js">
  </script>
  <script type="text/javascript" src="/sink/js/banner.js">
  </script>
</head>
<body>

';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'sink/head.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo ' 

  <!-- 顶部导航的模板 -->
    <textarea id="topNavBarTpl" style="display:none;">

	 </textarea>
  <script type="text/javascript">
    $(function() {
      CS.common.init();
    });
  </script>
  <!-- <div class="wrap">  -->
  <link rel="stylesheet" type="text/css" href="/sink/css/index.css"
  />
  </head>
  
  <body>
    <div class="pageCenter">
      <div class="mainNavWrap cf">
        <a class="yqLogo" href="/">
          <img src="/sink/image/logo.png" width="181"
          height="80" alt="创酷中文网" title="创酷中文网" />
        </a>
<a class="topBanner" target="_blank" href="http://www.acoolread.com/info/34.html"><img width="725" height="80" alt="#"  title="" src="/sink/image/cjtssy.png" ></a>   
<li><a href="http://www.acoolread.com/modules/article/group.php?id=1" target="_blank" title="创酷男生网"><strong><font color="#50ADAD";font size="2.8px";>┠男生站</font></strong></a></li>
<li><a href="http://www.acoolread.com/modules/article/group.php?id=2" target="_blank" title="创酷言情小说网"><strong><font color="#50ADAD";font size="2.8px";>┠言情站</font></strong></a></li><li><a href="http://wap.acoolread.com" target="_blank" title="手机创酷网"><strong><font color="#50ADAD";font size="2.8px";>┠男生wap站</font></strong></a></li>
<li><a href="http://m.acoolread.com" target="_blank" title="手机创酷网"><strong><font color="#50ADAD";font size="2.8px";>┠女生wap站</font></strong></a></li>
      </div>
      <div class="head_mainnav">
        <div class="head_mainnav_hd cf">
          <h3>
            <a href="'.$this->_tpl_vars['jieqi_url'].'/">
              首页
            </a>
          </h3>
		  ';
if($this->_tpl_vars['id'] == 2){
echo '<span>
          </span>';
}
echo '
       
          <h3>
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlefilter.php">
              书库
            </a>
          </h3>
          <span>
          </span>
          <h3>
            <a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" target="_blank">
              充值
            </a>
          </h3>
          <span>
          </span>
 <h3>
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myarticle.php">
              作家中心
            </a>
          </h3>
          <span>
          </span>
          <h3>
          <a href="http://www.acoolread.com/modules/fuli/2016.html" target="_blank">
              作者福利
            </a>
          </h3>

          <div class="headSerachBox">
               <form action="/modules/article/search.php" method="post">
				<input type="text" name="searchkey" class="search_text" placeholder="搜索一下吧！"/>
				<input type="submit" value="" class="search_button">
			</form>


          </div>
        </div>
        <div class="head_mainnav_bd cf">
          <div class="subClass">
            <a href="'.jieqi_geturl('article','articlelist','1','1').'">
              玄幻·魔法
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','2').'">
              武侠·修真
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','3').'">
              都市·校园
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','4').'">
              历史·军事
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','5').'">
              游戏·竞技
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','6').'">
              科幻·同人
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','7').'">
              现代·言情
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','8').'">
              古代·言情
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','9').'">
              幻想·言情
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','10').'">
              综合·其他
            </a>
          </div>

        </div>

      </div>
    </div>
     <div class="pageCenter">
      <!--第一屏-->
      <div class="indexOne mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
          <div class="threeTabBox">
            <em>
              '.$this->_tpl_vars['groupname'].'本周强推
            </em>
          </div>
          <div class="listWrap">
            <div class="tabList">
              <ul class="rankList">
'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'

              </ul>

            </div>
          </div>
        </div>
        <div class="indexOneCenter">
          <!-- 大图轮播 -->
		<div id="slideshow" class="block">
			<div id="focus">
				<ul>
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['3']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['4']['content'];
}
echo '
				</ul>
			</div>
		</div>

        </div>
        <div class="tabWrap mb10 fr">
          <div class="threeTabBox">
            <em>
              '.$this->_tpl_vars['groupname'].'最新上架
            </em>
          </div>
          <div class="rankListWrap">
            <ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['5']['content'].'
            </ul>
          </div>
        </div>
 
      </div>

      <!--第二屏-->
      <div class="indexTwo mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
          <div class="threeTabBox">
            <em>
              '.$this->_tpl_vars['groupname'].'原创风云榜
            </em>
          </div>
          <div class="listWrap">
            <ul class="rankList rankHover numList">
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['6']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['1']['content'];
}
echo '
            </ul>
          </div>
        </div>
        <div class="indexCenter">
          <h6>';
if($this->_tpl_vars['id'] == 2){
echo '现代·言情';
}else{
echo '玄幻·仙侠';
}
echo '</h6>
          <div class="recBookWrap">
            <div class="recBook cf">
              <div class="twoBookWrap">
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['8']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['7']['content'];
}
echo '
			                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="tabWrap tabSwitch fr">
          <div class="threeTabBox">
<em> 签约人气周榜</em>
          </div>
          <div class="listWrap">
            <ul class="rankList rankHover numList tabList">
'.$this->_tpl_vars['jieqi_pageblocks']['9']['content'].'

            </ul>

          </div>
        </div>
      </div>
      <!--第三屏-->
      <div class="indexThree mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
          <div class="threeTabBox">
            <em>
              '.$this->_tpl_vars['groupname'].'鲜花榜
            </em>
          </div>
          <div class="listWrap">
            <ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['10']['content'].'
            </ul>
          </div>
        </div>
        <div class="indexCenter">
          <h6>';
if($this->_tpl_vars['id'] == 2){
echo '古代·言情';
}else{
echo '都市·校园';
}
echo '</h6>
          <div class="recBookWrap">
            <div class="recBook cf">
              <div class="twoBookWrap">
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['12']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['11']['content'];
}
echo '
                </ul>
              </div>
            </div>

          </div>
        </div>
        <!--作品人气榜-->
        <div class="tabWrap tabSwitch fr">
         <div class="threeTabBox">
            <em>
             '.$this->_tpl_vars['groupname'].'总推荐榜
            </em>
          </div>
          <div class="listWrap">

            <ul class="rankList rankHover numList tabList">
 '.$this->_tpl_vars['jieqi_pageblocks']['13']['content'].'
            </ul>

          </div>
        </div>
      </div>
      <!--第四屏-->
      <div class="indexFour mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
       <div class="threeTabBox">
            <em>
             '.$this->_tpl_vars['groupname'].'月票榜
            </em>
          </div>
          <div class="listWrap">
            <ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['14']['content'].'
            </ul>

          </div>
        </div>
        <div class="indexCenter">
          <h6>';
if($this->_tpl_vars['id'] == 2){
echo '幻想·言情';
}else{
echo '灵异·悬疑';
}
echo '</h6>
          <div class="recBookWrap">
            <div class="recBook cf">
              <div class="twoBookWrap">
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['16']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['15']['content'];
}
echo '
                </ul>
              </div>
            </div>

          </div>
        </div>
        <div class="tabWrap fr">
          <div class="threeTabBox">
            <em>
             '.$this->_tpl_vars['groupname'].'VIP免费
            </em>
          </div>
          <div class="rankListWrap">
            <ul class="rankList rankHover numList">
 '.$this->_tpl_vars['jieqi_pageblocks']['17']['content'].'
            </ul>
          </div>
        </div>
      </div>


 
      <!--底部第七屏-->
      <div class="indexSeven mb10 cf">
        <div class="fl mr10">
          <div class="tabWrap tabSwitch mb10">
       <div class="threeTabBox">
            <em>
             '.$this->_tpl_vars['groupname'].'字数榜
            </em>
          </div>
            <div class="listWrap">
              <ul class="rankList rankHover numList tabList">
  '.$this->_tpl_vars['jieqi_pageblocks']['18']['content'].'
              </ul>
            </div>
          </div>
        </div>
        <!--最新小说更新列表-->
        <div class="indexCenter newUpdate">
          <h6>
            '.$this->_tpl_vars['groupname'].'最新小说更新列表
          </h6>
          <div id="updateTabBox" class="updateTabBox">
            <div class="updateTab">
              <ul>
                <li class="upCur">
                  免费小说
                </li>
                <li>
                  VIP小说
                </li>
                <li class="noborder">
                  签约小说
                </li>
              </ul>
            </div>
          </div>
          <div id="updateList" class="updateList">
            
            <ul>
 '.$this->_tpl_vars['jieqi_pageblocks']['21']['content'].'
            </ul>
           
            <ul class="hidden">
 '.$this->_tpl_vars['jieqi_pageblocks']['22']['content'].'
            </ul>
           
            <ul class="hidden">
 '.$this->_tpl_vars['jieqi_pageblocks']['23']['content'].'
            </ul>
          </div>
        </div>
        <div class="fr">
          <div class="tabWrap mb10">
            <div class="twoTabBox">
              <h3>
                '.$this->_tpl_vars['groupname'].'最新入库
              </h3>
            </div>
            <div class="rankListWrap">
              <ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['25']['content'].'
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
    <br>
    <a id="totop" class="go_top" href="javascript:">
    </a>
  </body>
  
  </html>
  

  <div class="footer">
    <div class="footer_main cf">

 
      <div class="foot">
        <p>
        
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=27&lpage=1&page=1" target="_blank" rel="nofollow">
            关于本站
          </a>
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=28&lpage=1&page=1" target="_blank" rel="nofollow">
            商务合作
          </a>
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=29&lpage=1&page=1" target="_blank" rel="nofollow">
            我要投稿
          </a>
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=30&lpage=1&page=1" target="_blank" rel="nofollow">
            版权声明
          </a>
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=31&lpage=1&page=1" target="_blank" rel="nofollow">
            联系我们
          </a>
        </p>
        <p>
          Copyright&nbsp;&nbsp;&copy;&nbsp;2015&nbsp;Acoolread.&nbsp;All&nbsp;Rights&nbsp;Reserved
        </p>
        <p>
   作者发布<a href="http://www.acoolread.com" style="margin: 0px;">小说</a>作品时，请遵守国家互联网信息管理办法规定。本站所收录小说作品、社区话题、书库评论均属其个人行为，不代表本站立场。
        </p>            
        <p>
    我们拒绝任何色情小说，拒绝任何抄袭复制侵犯版权的小说，一经发现，即作删除！
        </p>       
        <p>
          创酷中文网&nbsp;版权所有 苏ICP备14039675号-3
        </p>
      </div>
    </div>
  </div>
  <a id="goTopBtn" class="go_top" href="javascript:">
  </a>

  </div>
</body>

</html>';
?>