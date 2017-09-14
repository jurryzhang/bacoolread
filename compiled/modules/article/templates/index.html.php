<?php
echo '<!doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'" />
    <meta name="keywords" content="'.$this->_tpl_vars['articlename'].' '.$this->_tpl_vars['author'].' '.$this->_tpl_vars['sort'].' {$jieqi_sitename?}" />
    <meta name="description" content="'.truncate($this->_tpl_vars['intro'],'500','..').'" />
    <title>'.$this->_tpl_vars['articlename'].'-'.$this->_tpl_vars['author'].'-'.$this->_tpl_vars['sort'].'-'.$this->_tpl_vars['jieqi_sitename'].'</title>
    <link rel="stylesheet" type="text/css" href="/sink/css/base.css"/>
    <link rel="stylesheet" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/css/page.css" type="text/css" media="all" />
    <!--[if lt IE 9]><script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/html5.js"></script><![endif]-->
    <script type="text/javascript" src="/sink/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/common.js"></script>
    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/theme.js"></script>
    <script type="text/javascript" src="/sink/js/base.js"></script>
    <script type="text/javascript" src="/sink/js/layer.js"></script>
    <script type="text/javascript" src="/sink/js/page.js"></script>
    <script type="text/javascript">
        <!--
        var url_previous = "'.$this->_tpl_vars['url_previous'].'";
        var url_next = "'.$this->_tpl_vars['url_next'].'";
        var url_index = "'.$this->_tpl_vars['url_index'].'";
        var articleid = "'.$this->_tpl_vars['articleid'].'";
        var chapterid = "'.$this->_tpl_vars['chapterid'].'";

        function jumpPage() {
            var event = document.all ? window.event : arguments[0];
            if (event.keyCode == 37) location = url_previous;
            if (event.keyCode == 39) location = url_next;
            if (event.keyCode == 13) location = url_index;
        }
        document.onkeydown=jumpPage;
        -->
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
        <div class="head_mainnav_hd cf  clearfix">
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
            <a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['artileSort'][$this->_tpl_vars['i']['key']]['key']).'">
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
            <!--玄幻?魔法-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','2').'">-->
            <!--武侠?修真-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','3').'">-->
            <!--都市?校园-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','4').'">-->
            <!--历史?军事-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','5').'">-->
            <!--游戏?竞技-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','6').'">-->
            <!--科幻?同人-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','7').'">-->
            <!--现代?言情-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','8').'">-->
            <!--古代?言情-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','9').'">-->
            <!--幻想?言情-->
            <!--</a>-->
            <!--<span>-->
            <!--|-->
            <!--</span>-->
            <!--<a href="'.jieqi_geturl('article','articlelist','1','10').'">-->
            <!--综合?其他-->
            <!--</a>-->
        </div>

    </div>

</div>
</div>
<div class="pageCenter">


    <div class="headlink cf">
        <div class="linkleft"><a href="'.$this->_tpl_vars['jieqi_main_url'].'/">'.$this->_tpl_vars['jieqi_sitename'].'</a> &gt; <a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['sortid']).'">'.$this->_tpl_vars['sort'].'</a> &gt; <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info').'">'.$this->_tpl_vars['articlename'].'</a></div>

        <div class="linkright"><a href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/addbookcase.php?bid='.$this->_tpl_vars['articleid'].'\');">加入书架</a> | <a href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/uservote.php?id='.$this->_tpl_vars['articleid'].'\');">推荐本书</a> | <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info').'">返回书页</a></div>
    </div>

    <div class="fullbar"><script type="text/javascript" src="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/scripts/indextop.js"></script></div>

    <div class="main">
        <div class="indexhead">
            <div class="artname">'.$this->_tpl_vars['articlename'].'</div>
            <div class="ainfo">
                作者：<a href="'.jieqi_geturl('article','author',$this->_tpl_vars['authorid'],$this->_tpl_vars['author']).'" target="_blank">'.$this->_tpl_vars['author'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;
                章节数：'.$this->_tpl_vars['chapters'].'&nbsp;&nbsp;&nbsp;&nbsp;
                状态：'.$this->_tpl_vars['fullflag'].'
            </div>
        </div>

        <div class="index">
            ';
if (empty($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = array();
elseif (!is_array($this->_tpl_vars['chapterrows'])) $this->_tpl_vars['chapterrows'] = (array)$this->_tpl_vars['chapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['chapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['chapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['chapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['chapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] > 0){
echo '
            ';
if($this->_tpl_vars['i']['order'] > 1){
echo '</ul>';
}
echo '
            <div class="volume">
                '.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'
                ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip'] == 0){
}
echo '
            </div>
            ';
if($this->_tpl_vars['i']['order'] < $this->_tpl_vars['i']['count']){
echo '<ul class="chapters">';
}
echo '
            ';
}else{
echo '
            ';
if($this->_tpl_vars['i']['order'] == 1){
echo '<ul class="chapters">';
}
echo '
			';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display'] == 0){
echo '
                <li class="chapter">                    
                    ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip'] > 0){
echo '
                    <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'" title="'.date('Y-m-d H:i',$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'更新，共'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['size_c'].'字，价格：'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['saleprice'].'"';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display'] != 0){
echo ' class="gray"';
}
echo '>'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a><em>VIP</em>
                    ';
}else{
echo '
                    <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'" title="'.date('Y-m-d H:i',$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'更新，共'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['size_c'].'字"';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display'] != 0){
echo ' class="gray"';
}
echo '>'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a>
                    ';
}
echo '
                </li>
				 ';
}
echo '
                ';
if($this->_tpl_vars['i']['order'] == $this->_tpl_vars['i']['count']){
echo '</ul>';
}
echo '
            ';
}
echo '
            ';
}
echo '
        </div>
        <br>
        <a id="totop" class="go_top" href="javascript:">
        </a>

    </div>
</div>
<div class="footer">
    <div class="footer_main cf">
        <div class="foot">
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
            </p
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
</div>
<a id="goTopBtn" class="go_top" href="javascript:">
</a>
</div>
</div>
</body>

</html>
';
?>