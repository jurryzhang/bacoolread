<?php
echo '<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb">
<meta property="wb:webmaster" content="9ae527887cbbe288" />
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<meta id="ctl00_metaKeywords" content="小说,小说网,言情小说,青春小说,玄幻小说,武侠小说,都市小说,历史小说,网络小说,原创网络文学" name="keywords">

<meta id="ctl00_metaDescription" content="小说test阅读,精彩小说尽在'.$this->_tpl_vars['jieqi_pagetitle'].'。'.$this->_tpl_vars['jieqi_pagetitle'].'提供玄幻小说,武侠小说,原创小说,网游小说,都市小说,言情小说,青春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说最新章节免费小说阅读,精彩尽在'.$this->_tpl_vars['jieqi_pagetitle'].'！热门小说:莽荒纪,绝世唐门,天骄无双,胜者为王,醉枕江山。" name="description">
<!-- 360安全游览器使用webkit极速核 -->
<meta property="qc:admins" content="216137574661377425146375" />
<meta name="renderer" content="webkit" />
<meta name="baidu-site-verification" content="RF6mkvL6i7" />
<meta name="description" content="'.$this->_tpl_vars['jieqi_pagetitle'].'网络test各界小说高手,每日更新小说连载,小说排行榜更是提供全网最收欢迎的小说下载,当下最好看的小说,如言情小说.穿越小说.玄幻小说等.找最好看的免费小说就来'.$this->_tpl_vars['jieqi_pagetitle'].'."  />
<meta name="keywords" content="小说,小说排行榜,免费小说下载,好看的小说" />
<!-- IE使用它支持的最高模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="baidu-site-verification" content="3R33MUNLCM" />
<title>小说_小说排行榜_'.$this->_tpl_vars['jieqi_pagetitle'].'|免费小说下载_最好看的小说网</title>
<script type="text/javascript" src="/scripts/url/index.js"></script>
<link href="/favicon.ico" type="image/x-icon"  rel="shortcut icon">
<link href="/favicon.ico" type="image/x-icon"  rel="Bookmark">
<link rel="stylesheet" type="text/css" href="sink/css/base.css"  />
<script type="text/javascript" src="/sink/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/sink/js/base.js"></script>
<script type="text/javascript" src="/sink/js/layer.js"></script>
<script type="text/javascript" src="/sink/js/page.js"></script>
<script type="text/javascript" src="/sink/js/tcss.ping.js"></script>
<script type="text/javascript" src="/sink/js/banner.js"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'sink/head.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo '
<script type="text/javascript">
    $(function() {
        CS.common.init();
    });
</script>
<!-- <div class="wrap">  -->
<link rel="stylesheet" type="text/css" href="sink/css/index.css"  />

</head>
<body onselectstart="return false">
<body>
<div class="pageCenter">
    <div class="mainNavWrap cf">
        <a class="yqLogo" href="/">
            <img src="/sink/image/logo.png" width="181" height="80" alt="'.$this->_tpl_vars['jieqi_pagetitle'].'" title="'.$this->_tpl_vars['jieqi_pagetitle'].'" />
        </a>
        <!-- 第一广告条 -->
        <a class="topBanner" target="_blank" href="http://www.mianfeidushu.com/info/24.html">
            <img width="800" height="80" alt="#"  title="" src="/sink/image/cjtssy.png" >
        </a>

    </div>
    <div class="head_mainnav">
        <div class="head_mainnav_hd cf">
            <h3 class="cur">
                <a href="'.$this->_tpl_vars['jieqi_url'].'/">
                    首页
                </a>
            </h3>

            <h3>
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlefilter.php">
                    书库

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
                <a href="http://www.mianfeidushu.com/user">
                    个人中心
                </a>
            </h3>
            <span>
          </span>
            <h3>
                <a href="http://www.mianfeidushu.com/modules/fuli/2016.html" target="_blank">
                    作者福利
                </a>
            </h3>
            <span>
          </span>
            <h3>
                <a href="http://m.mianfeidushu.com" target="_blank">
                    手机版
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
                <a href="http://www.mianfeidushu.com/modules/client/clientdownload.html" target="_blank">
                    客户端下载
                </a>
            </h3>

            <!--<div class="headSerachBox">
                  <form action="/modules/article/search.php" method="post">
                   <input type="text" name="searchkey" class="search_text" placeholder="搜索一下吧！"/>
                   <input type="submit" value="" class="search_button">
               </form> -->
        </div>
    </div>
    <div class="head_mainnav_bd cf">
        <div class="subClass">
            <!-- burn 修改 2016-12-19 -->
            ';
if (empty($this->_tpl_vars['artileSort'])) $this->_tpl_vars['artileSort'] = array();
elseif (!is_array($this->_tpl_vars['artileSort'])) $this->_tpl_vars['artileSort'] = (array)$this->_tpl_vars['artileSort'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['artileSort']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['artileSort']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['artileSort']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['artileSort']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['artileSort']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            <a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['artileSort'][$this->_tpl_vars['i']['key']]['sortID']).'">
                '.$this->_tpl_vars['artileSort'][$this->_tpl_vars['i']['key']]['caption'].'
            </a>
			
            ';
if($this->_tpl_vars['i']['key'] < $this->_tpl_vars['artileSortCount']){
echo '
            <span>
              |
            </span>
            ';
}
echo '

            ';
}
echo '


            <!--<a href="'.jieqi_geturl('article','articlelist','1','1').'">-->
                <!--'.$this->_tpl_vars['test'].'-->
            <!--</a>-->

            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','1').'">-->
                <!--玄幻·魔法-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','2').'">-->
                <!--武侠·修真-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','3').'">-->
                <!--都市·校园-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','4').'">-->
                <!--历史·军事-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','5').'">-->
                <!--灵异·悬疑-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','6').'">-->
                <!--科幻·同人-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','7').'">-->
                <!--现代·言情-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','8').'">-->
                <!--古代·言情-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','11').'">-->
                <!--耽美·同人-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','9').'">-->
                <!--幻想·言情-->
            <!--</a>-->
            <!--<span>-->
              <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','12').'">-->
                <!--文学-->
            <!--</a>-->
        </div>

    </div>
    <!--公告栏-->
    <div class="index_notice cf">
        '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
        </ul>
    </div>
</div>
</div>
</div>

<div class="pageCenter">
    <!--第一屏-->
    <div class="indexOne mb10 cf">
        <div class="tabWrap fl mr10">
            <div class="threeTabBox">
                <em>
                    男生强推
                </em>
            </div>
            <div class="listWrap">
                <div class="tabList">
                    <ul class="rankList rankHover numList">
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
                        '.$this->_tpl_vars['jieqi_pageblocks']['4']['content'].'
                    </ul>
                </div>
            </div>

        </div>
        <div class="tabWrap mb10 fr">
            <div class="threeTabBox">
                <em>
                    女生强推
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
        <div class="tabWrap fl mr10">
            <div class="threeTabBox">
                <em>
                    VIP榜
                </em>
            </div>
            <div class="rankListWrap">
                <ul class="rankList rankHover numList">
                    '.$this->_tpl_vars['jieqi_pageblocks']['17']['content'].'
                </ul>
            </div>
        </div>

        <div class="indexCenter">
            <h6>
                女生·推荐
            </h6>

            <div class="recBookWrap">
                <div class="recBook cf">
                    <div class="twoBookWrap">
                        '.$this->_tpl_vars['jieqi_pageblocks']['16']['content'].'
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabWrap tabSwitch fr">
            <div class="threeTabBox">
                <em>
                    总推荐榜
                </em>
            </div>
            <div class="listWrap">

                <ul class="rankList rankHover numList tabList">
                    '.$this->_tpl_vars['jieqi_pageblocks']['13']['content'].'
                </ul>

            </div>
        </div>

    </div>

    <!-- 第二广告条 -->
    <div class="banner_index"><a href=\'http://www.mianfeidushu.com/info/1754.html\'  target=\'_blank\' ><img src=\'http://www.mianfeidushu.com/sink/image/qqhfg.png\' height=\'95\'  width=\'1000\' /></a></div>
    <!--第三屏-->
    <div class="indexThree mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
            <div class="threeTabBox">
                <em>
                    鲜花榜
                </em>
            </div>
            <div class="listWrap">
                <ul class="rankList rankHover numList">
                    '.$this->_tpl_vars['jieqi_pageblocks']['10']['content'].'
                </ul>
            </div>
        </div>

        <div class="indexCenter">
            <h6>精品·频道</h6>
            <div class="recBookWrap">
                <div class="recBook cf">
                    <div class="twoBookWrap">
                        '.$this->_tpl_vars['jieqi_pageblocks']['7']['content'].'
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--作品人气榜-->
        <div class="tabWrap tabSwitch fr">
            <div class="threeTabBox">
                <em> 签约人气周榜</em>
            </div>
            <div class="listWrap">
                <ul class="rankList rankHover numList tabList">
                    '.$this->_tpl_vars['jieqi_pageblocks']['8']['content'].'

                </ul>

            </div>
        </div>
    </div>

    <!--第四屏-->
    <div class="indexFour mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
            <div class="threeTabBox">
                <em>
                    月票榜
                </em>
            </div>
            <div class="listWrap">
                <ul class="rankList rankHover numList">
                    '.$this->_tpl_vars['jieqi_pageblocks']['14']['content'].'
                </ul>

            </div>
        </div>

        <div class="indexCenter">
            <h6>
                男生·推荐
            </h6>
            <div class="recBookWrap">
                <div class="recBook cf">
                    <div class="twoBookWrap">
                        '.$this->_tpl_vars['jieqi_pageblocks']['11']['content'].'
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="tabWrap tabSwitch fl mr10">
            <div class="threeTabBox">
                <em>
                    原创风云榜
                </em>
            </div>
            <div class="listWrap">
                <ul class="rankList rankHover numList">
                    '.$this->_tpl_vars['jieqi_pageblocks']['6']['content'].'
                </ul>
            </div>
        </div>
    </div>

    <!-- 第三广告条 -->
    <div class="banner_index"><a href=\'http://www.mianfeidushu.com/info/1807.html\'  target=\'_blank\' ><img src=\'http://www.mianfeidushu.com/sink/image/yygs.png\' height=\'90\'  width=\'1000\' /></a></div>

    <!--底部第七屏-->
    <div class="indexSeven mb10 cf">
        <div class="fl mr10">
            <div class="tabWrap tabSwitch mb10">
                <div class="threeTabBox">
                    <em>
                        字数榜
                    </em>
                </div>
                <div class="listWrap">
                    <ul class="rankList rankHover numList tabList">
                        '.$this->_tpl_vars['jieqi_pageblocks']['18']['content'].'
                    </ul>
                </div>
            </div>
            <!--客服中心-->
            <div class="code">
                <h3>
                    客服中心
                </h3>
                <div class="service">
                    <div class="contact">
                        <p>
                            充值投诉:
                            <!--<a target=blank href=\'tencent://message/?uin=2565910086&Site=免费读书&Menu=yes\'>
								<img border="0" SRC=http://wpa.qq.com/pa?p=1:2565910086:1 alt="充值投诉请点这里">
							</a>-->
                            QQ：2565910086
                        </p>
                        <p>
                            男频责编:
                            <!--<a target=blank href=tencent://message/?uin=2565910086&Site=免费读书&Menu=yes>
							<img border="0" SRC=\'http://wpa.qq.com/pa?p=1:2565910086:1\' alt="男频投稿请点这里">
							</a>-->
                            QQ：2565910086
                        </p>
                        <p>
                            女频责编:
                            <!--<a target=blank href=tencent://message/?uin=95023750&Site=免费读书&Menu=yes>
							<img border="0" SRC=http://wpa.qq.com/pa?p=1:95023750:1 alt="女频投稿请点这里">
							</a>-->
                            QQ：2970310086
                        </p>

                        <em>
                            客诉邮箱：
                            <a href="mailto:2308810010@qq.com" target="_blank">
                                2308810010@qq.com
                            </a>
                        </em>
                        <em>
                            投稿邮箱：
                            <a href="mailto:982774791@qq.com" target="_blank">
                                982774791@qq.com
                            </a>
                        </em>

                        <!--<p class="cf">-->
                          <!--<span>-->
                            <!--微博:<wb:follow-button uid=" " type="red_2" width="136" height="24"></wb:follow-button>-->
                          <!--</span>-->
                        <!--</p>-->
                    </div>
                </div>
            </div>
        </div>

        <!--最新小说更新列表-->
        <div class="indexCenter newUpdate">
            <h6>
                最新小说更新列表
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
                        最新入库
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

        <!-- <span>
        合作渠道
          </span>
          <div class="link_a">
    '.$this->_tpl_vars['jieqi_pageblocks']['26']['content'].'
          </div>
          <div class="user clearfix">
            <dl class="user_dl">
              <dt>
              </dt>

           <dd>
                <a target="_blank" href="#">
                  意见反馈
                </a>
                <br>
                <a target="_blank" href="#">
                  本站客服
                </a>
              </dd>
            </dl>
            <dl class="cooperate_dl">
              <dt>
              </dt>
              <dd>
                <p>
                  版权合作：
                  <a href="#">
                    2261740690@qq.com
                  </a>
                </p>
                <p>
                广告合作：
                  <a href="#">
                   2262380196@qq.com
                  </a>
                </p>
              </dd>
            </dl>

         </div>   <div class="foot"> -->

        <div class="link_a">
            <span>友情链接</span>
            <a target="_blank" href="http://t.shuqi.com">书旗小说网</a>
			<a target="_blank" href="http://www.ziycw.com/">最爱原创网</a>
			<a target="_blank" href="http://www.dayuread.com/">大鱼中文网</a>
			<a target="_blank" href="http://www.91shenshu.com/">九一神书网</a>
        </div></div>

    <div class="foot">
        <p>

        <p>
            <!--<div class="">
             免费读书是深受年轻人喜爱的小说阅读网站，网站始终致力于为广大读者和作者创造一个不一样的阅读世界！找好看的网络小说，免费的网络小说，小说最新排行榜就上免费读书。免费读书，由多位资深编辑共同运营！我们拥有强大的第三方小说运营渠道，努力让优秀的作品绽放不一样的光彩!目前达成战略合作的渠道有：掌阅、书旗、畅读书城、爱奇艺等十多家无线平台！
             </p> -->
        <p>
            <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=3&lpage=1&page=1" target="_blank" rel="nofollow">
                关于本站
            </a>
            <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=4&lpage=1&page=1" target="_blank" rel="nofollow">
                商务合作
            </a>
            <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=5&lpage=1&page=1" target="_blank" rel="nofollow">
                我要投稿
            </a>
            <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=6&lpage=1&page=1" target="_blank" rel="nofollow">
                版权声明
            </a>
            <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=7&lpage=1&page=1" target="_blank" rel="nofollow">
                联系我们
            </a>
            <a href="http://m.mianfeidushu.com" target="_blank" rel="nofollow">
                手机版
            </a>
            <a href="http://www.mianfeidushu.com/modules/fuli/2016.html" target="_blank" rel="nofollow">
                作者福利
            </a>
        </p>
        <p>
            Copyright&nbsp;&nbsp;&copy;&nbsp;2016&nbsp;mianfeidushu.&nbsp;All&nbsp;Rights&nbsp;Reserved
        </p>
        <p>
            作者发布小说作品时，请遵守国家互联网信息管理办法规定。本站所收录小说作品、社区话题、书库评论均属其个人行为，不代表本站立场。
        </p>
        <p>
            我们拒绝任何色情小说，拒绝任何抄袭复制侵犯版权的小说，一经发现，即作删除！
        </p>
        <p>
            免费读书&nbsp;版权所有&nbsp;郑州心动文化传媒有限公司</a><a href="http://www.miibeian.gov.cn/ " target="_blank" rel="nofollow">&nbsp;豫ICP备16025525号-1
        <p>
            <script src="http://s4.cnzz.com/z_stat.php?id=1256806858&web_id=1256806858" language="JavaScript"></script>
        </p>
    </div>
</div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"7","bdPos":"right","bdTop":"100"}};with(document)0[(getElementsByTagName(\'head\')[0]||body).appendChild(createElement(\'script\')).src=\'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=\'+~(-new Date()/36e5)];</script>
</div>
<a id="goTopBtn" class="go_top" href="javascript:">
</a>
<script type="text/javascript" src="sink/js/gb.js"></script>
</div>
</body>
</html>
';
?>