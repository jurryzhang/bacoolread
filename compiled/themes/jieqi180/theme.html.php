<?php
echo '<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=GBK" />
    <meta id="ctl00_metaKeywords" content="小说,小说网,言情小说,青春小说,玄幻小说,武侠小说,都市小说,历史小说,网络小说,原创网络文学"
          name="keywords">
    <meta id="ctl00_metaDescription" content="小说阅读,精彩小说尽在'.$this->_tpl_vars['jieqi_pagetitle'].'。'.$this->_tpl_vars['jieqi_pagetitle'].'提供玄幻小说,武侠小说,原创小说,网游小说,都市小说,言情小说,青春小说,历史小说,军事小说,网游小说,科幻小说,恐怖小说,首发小说最新章节免费小说阅读,精彩尽在'.$this->_tpl_vars['jieqi_pagetitle'].'！热门小说:莽荒纪,绝世唐门,天骄无双,胜者为王,醉枕江山。"
          name="description">
    <!-- 360安全游览器使用webkit极速核 -->
    <meta name="renderer" content="webkit" />
    <meta name="description" content="'.$this->_tpl_vars['jieqi_pagetitle'].'网络各界小说高手,每日更新小说连载,小说排行榜更是提供全网最收欢迎的小说下载,当下最好看的小说,如言情小说.穿越小说.玄幻小说等.找最好看的免费小说就来'.$this->_tpl_vars['jieqi_pagetitle'].'."
    />
    <meta name="keywords" content="小说,小说排行榜,免费小说下载,好看的小说" />
    <!-- IE使用它支持的最高模式 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="baidu-site-verification" content="3R33MUNLCM" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$this->_tpl_vars['jieqi_pagetitle'].'</title>
    <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link href="/favicon.ico" type="image/x-icon" rel="Bookmark">
    <link rel="stylesheet" type="text/css" href="/sink/css/base.css"/>';
if(strstr($this->_tpl_vars['jieqi_thisurl'],'info') !== false){
echo '
    <script type="text/javascript">
        var article_id = "'.$this->_tpl_vars['articleid'].'";
    </script>
    <script type="text/javascript" src="/scripts/url/info.js"></script>';
}
echo '
    <!--<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/jquery-1.7.min.js"></script>-->
    <script type="text/javascript" src="/sink/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/sink/js/base.js"></script>
    <script type="text/javascript" src="/sink/js/layer.js"></script>
    <script type="text/javascript" src="/sink/js/page.js"></script>
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
<div class="pageCenter">
    <div class="mainNavWrap cf">
        <a class="yqLogo" href="/">
            <img src="/sink/image/logo.png" width="181"
                 height="80" alt="'.$this->_tpl_vars['jieqi_pagetitle'].'" title="'.$this->_tpl_vars['jieqi_pagetitle'].'" />
        </a>

        <!-- 非首页第一条广告 -->
        <a class="topBanner" target="_blank" href="http://www.mianfeidushu.com/info/24.html"><img width="800" height="80" alt="#"  title="" src="/sink/image/cjtssy.png" ></a>

    </div>
    <div class="head_mainnav">
        <div class="head_mainnav_hd cf  clearfix">
            <h3>
                <a href="'.$this->_tpl_vars['jieqi_url'].'/">
                    首页
                </a>
            </h3>


            ';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'articlefilter.php' || basename($this->_tpl_vars['jieqi_thisfile']) == 'articleinfo.php'){
}else{
echo '<span>
          </span>';
}
echo '
            <h3';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'articlefilter.php' || basename($this->_tpl_vars['jieqi_thisfile']) == 'articleinfo.php'){
echo ' class="cur"';
}
echo '>
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlefilter.php">
                书库
            </a>
            </h3>
            ';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'articlefilter.php' || basename($this->_tpl_vars['jieqi_thisfile']) == 'articleinfo.php'){
}else{
echo '<span>
          </span>';
}
echo '


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
            <a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['i']['key']).'">
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
                <!--玄test幻·魔法-->
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

</div>
</div>
<div class="pageCenter">
    ';
if($this->_tpl_vars['jieqi_top_bar'] != ""){
echo $this->_tpl_vars['jieqi_top_bar'];
}
echo '
    ';
if($this->_tpl_vars['jieqi_showtblock'] == 1){
echo '
    ';
if (empty($this->_tpl_vars['jieqi_tblocks'])) $this->_tpl_vars['jieqi_tblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_tblocks'])) $this->_tpl_vars['jieqi_tblocks'] = (array)$this->_tpl_vars['jieqi_tblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_tblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_tblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_tblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_tblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_tblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
    ';
if($this->_tpl_vars['jieqi_tblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_tblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_tblocks'][$this->_tpl_vars['i']['key']]['content'].'
    ';
}
echo '
    ';
}
echo '

    ';
if(empty($this->_tpl_vars['jieqi_clblocks']) == false || empty($this->_tpl_vars['jieqi_crblocks']) == false){
echo '

    ';
if (empty($this->_tpl_vars['jieqi_clblocks'])) $this->_tpl_vars['jieqi_clblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_clblocks'])) $this->_tpl_vars['jieqi_clblocks'] = (array)$this->_tpl_vars['jieqi_clblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_clblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_clblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_clblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_clblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_clblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

    ';
if($this->_tpl_vars['jieqi_clblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_clblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_clblocks'][$this->_tpl_vars['i']['key']]['content'].'

    ';
}
echo '

    ';
if (empty($this->_tpl_vars['jieqi_crblocks'])) $this->_tpl_vars['jieqi_crblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_crblocks'])) $this->_tpl_vars['jieqi_crblocks'] = (array)$this->_tpl_vars['jieqi_crblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_crblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_crblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_crblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_crblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_crblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

    ';
if($this->_tpl_vars['jieqi_crblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_crblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_crblocks'][$this->_tpl_vars['i']['key']]['content'].'

    ';
}
echo '

    ';
}
echo '


    ';
if($this->_tpl_vars['jieqi_showlblock'] == 1){
echo '

    ';
if (empty($this->_tpl_vars['jieqi_lblocks'])) $this->_tpl_vars['jieqi_lblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_lblocks'])) $this->_tpl_vars['jieqi_lblocks'] = (array)$this->_tpl_vars['jieqi_lblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_lblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_lblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_lblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_lblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_lblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

    ';
if($this->_tpl_vars['jieqi_lblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_lblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_lblocks'][$this->_tpl_vars['i']['key']]['content'].'

    ';
}
echo '

    ';
if($this->_tpl_vars['jieqi_showrblock'] == 1){
}else{
}
echo '
    ';
}else{
echo '
    ';
if($this->_tpl_vars['jieqi_showrblock'] == 1){
}else{
}
echo '
    ';
}
echo '
    ';
if($this->_tpl_vars['jieqi_showcblock'] == 1){
echo '
    ';
if (empty($this->_tpl_vars['jieqi_ctblocks'])) $this->_tpl_vars['jieqi_ctblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_ctblocks'])) $this->_tpl_vars['jieqi_ctblocks'] = (array)$this->_tpl_vars['jieqi_ctblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_ctblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_ctblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_ctblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_ctblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_ctblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

    ';
if($this->_tpl_vars['jieqi_ctblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_ctblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_ctblocks'][$this->_tpl_vars['i']['key']]['content'].'

    ';
}
echo '
    ';
if (empty($this->_tpl_vars['jieqi_cmblocks'])) $this->_tpl_vars['jieqi_cmblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_cmblocks'])) $this->_tpl_vars['jieqi_cmblocks'] = (array)$this->_tpl_vars['jieqi_cmblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_cmblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_cmblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_cmblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_cmblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_cmblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

    ';
if($this->_tpl_vars['jieqi_cmblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_cmblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_cmblocks'][$this->_tpl_vars['i']['key']]['content'].'

    ';
}
echo '
    ';
}
echo '
    ';
if($this->_tpl_vars['jieqi_contents'] != ""){
echo $this->_tpl_vars['jieqi_contents'];
}
echo '
    ';
if($this->_tpl_vars['jieqi_showcblock'] == 1){
echo '
    ';
if (empty($this->_tpl_vars['jieqi_cbblocks'])) $this->_tpl_vars['jieqi_cbblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_cbblocks'])) $this->_tpl_vars['jieqi_cbblocks'] = (array)$this->_tpl_vars['jieqi_cbblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_cbblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_cbblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_cbblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_cbblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_cbblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

    ';
if($this->_tpl_vars['jieqi_cbblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_cbblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_cbblocks'][$this->_tpl_vars['i']['key']]['content'].'

    ';
}
echo '
    ';
}
echo '

    ';
if($this->_tpl_vars['jieqi_showrblock'] == 1){
echo '

    ';
if (empty($this->_tpl_vars['jieqi_rblocks'])) $this->_tpl_vars['jieqi_rblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_rblocks'])) $this->_tpl_vars['jieqi_rblocks'] = (array)$this->_tpl_vars['jieqi_rblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_rblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_rblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_rblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_rblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_rblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

    ';
if($this->_tpl_vars['jieqi_rblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_rblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_rblocks'][$this->_tpl_vars['i']['key']]['content'].'

    ';
}
echo '

    ';
}
echo '


    ';
if($this->_tpl_vars['jieqi_showbblock'] == 1){
echo '
    ';
if (empty($this->_tpl_vars['jieqi_bblocks'])) $this->_tpl_vars['jieqi_bblocks'] = array();
elseif (!is_array($this->_tpl_vars['jieqi_bblocks'])) $this->_tpl_vars['jieqi_bblocks'] = (array)$this->_tpl_vars['jieqi_bblocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqi_bblocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqi_bblocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqi_bblocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqi_bblocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqi_bblocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '

    ';
if($this->_tpl_vars['jieqi_bblocks'][$this->_tpl_vars['i']['key']]['title'] != ""){
echo $this->_tpl_vars['jieqi_bblocks'][$this->_tpl_vars['i']['key']]['title'];
}
echo '
    '.$this->_tpl_vars['jieqi_bblocks'][$this->_tpl_vars['i']['key']]['content'].'
    ';
}
echo '
    ';
}
echo '
    ';
if($this->_tpl_vars['jieqi_bottom_bar'] != ""){
echo $this->_tpl_vars['jieqi_bottom_bar'];
}
echo '


    <br>
    <a id="totop" class="go_top" href="javascript:">
    </a>


</div>
<div class="footer">
    <div class="footer_main cf">

        <div class="foot">
            <p>
                <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=27&lpage=1&page=1" target="_blank" rel="nofollow">
                    关于本站
                </a>
                <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=28&lpage=1&page=1" target="_blank" rel="nofollow">
                    商务合作
                </a>
                <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=29&lpage=1&page=1" target="_blank" rel="nofollow">
                    我要投稿
                </a>
                <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=30&lpage=1&page=1" target="_blank" rel="nofollow">
                    版权声明
                </a>
                <a href="http://www.mianfeidushu.com/modules/forum/showtopic.php?tid=31&lpage=1&page=1" target="_blank" rel="nofollow">
                    联系我们
                </a>
            </p>
            <p>
                Copyright&nbsp;&nbsp;&copy;&nbsp;2015&nbsp;mianfeidushu.&nbsp;All&nbsp;Rights&nbsp;Reserved
            </p>
            <p>
                作者发布<a href="http://www.mianfeidushu.com" style="margin: 0px;">小说</a>作品时，请遵守国家互联网信息管理办法规定。本站所收录小说作品、社区话题、书库评论均属其个人行为，不代表本站立场。
            </p>
            <p>
                我们拒绝任何色情小说，拒绝任何抄袭复制侵犯版权的小说，一经发现，即作删除!
            </p>
            <p>
                免费读书&nbsp;版权所有 豫ICP备16025525号-1
            </p>
        </div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"7","bdPos":"right","bdTop":"100"}};with(document)0[(getElementsByTagName(\'head\')[0]||body).appendChild(createElement(\'script\')).src=\'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=\'+~(-new Date()/36e5)];</script>
    </div>
</div>
<a id="goTopBtn" class="go_top" href="javascript:">
</a>

</div>
</body>

</html>
';
?>