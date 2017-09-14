<?php
echo '
<style type="text/css">
ul.am_chapters{
	list-style: none;
	clear: both;
	text-align: left;
	width: 100%;
}

ul.am_chapters a.am_act{
	color: #336699;
}

li.am_chapter{
	float: left;
	width: 50%;
	padding: 0;
	margin: 0;
	line-height: 200%;
}

li.am_chapter em{
	color: #ff6600;
}

li.am_volume{
	width: 100%;
	padding: 0;
	margin: 0;
	clear: both;
	font-size: 14px;
	font-weight: bold;
	text-align: center;
	line-height: 200%;
	border-top: 1px solid #eaeaea;
	border-bottom: 1px solid #eaeaea;
}

ul.am_packflag{
	list-style: none;
	clear: both;
	text-align: left;
	width: 100%;
}

ul.am_packflag li{
	float: left;
	padding: 0;
	margin: 0;
	width: 50%;
	line-height: 150%;
}
</style>
<script type="text/javascript">
	function changeAction(){
                                //默认是login.action，当select改变时同时改变from的action属性
                                //我这里直接把列表的value赋值到form的action，你可以根据需要改改
		var selectValue=document.getElementById(\'act\').value;
		var deletes = \''.$this->_tpl_vars['url_chaptersdel'].'\';
		var types = \''.$this->_tpl_vars['article_static_url'].'/chaptersset.php\';
		if(selectValue == \'delete\'){
		document.chapterdel.action=deletes;
		}
		else{
		document.chapterdel.action=types;
		}
	}
	</script>
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/sink/js/common.js"></script>
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<table class="grid" cellspacing="1" width="100%" align="center">
<form name="chapterdel" id="chapterdel" action="'.$this->_tpl_vars['url_chaptersdel'].'" method="post">
 <caption>《'.$this->_tpl_vars['articlename'].'》[<a href="'.$this->_tpl_vars['url_articleinfo'].'" target="_blank">信息</a>] [<a href="'.$this->_tpl_vars['url_articleindex'].'" target="_blank">阅读</a>]</caption>
 <tr>
   <td align="center" class="head">
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/newvolume.php?aid='.$this->_tpl_vars['articleid'].'">新建分卷</a> 
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/newchapter.php?aid='.$this->_tpl_vars['articleid'].'">增加章节</a> 
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/articleedit.php?id='.$this->_tpl_vars['articleid'].'">编辑小说</a> 
   <!-- burn 2016-12-6 modify -->
   <!--<a class="btnlink" id="act_delete" href="javascript:;" onclick="if(confirm(\'确实要删除该小说么？\')) Ajax.Tip(\''.$this->_tpl_vars['article_static_url'].'/articledel.php?id='.$this->_tpl_vars['articleid'].'&act=delete'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});">删除小说</a>-->
   
   <a class="btnlink" id="act_delete" href="javascript:;" onclick="if(confirm(\'确实要删除该小说么？\')) href=\''.$this->_tpl_vars['article_static_url'].'/articledel.php?id='.$this->_tpl_vars['articleid'].'&act=delete'.$this->_tpl_vars['jieqi_token_url'].'\';">删除小说</a>
   
   <!--<a class="btnlink" id="act_delete" href="javascript:;" onclick="if(confirm(\'确实要清空（删除所有章节）该小说么？\')) Ajax.Tip(\''.$this->_tpl_vars['article_static_url'].'/articleclean.php?id='.$this->_tpl_vars['articleid'].'&act=clean'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});">清空小说</a> -->
   
   <a class="btnlink" id="act_delete" href="javascript:;" onclick="if(confirm(\'确实要清空（删除所有章节）该小说么？\')) href=\''.$this->_tpl_vars['article_static_url'].'/articleclean.php?id='.$this->_tpl_vars['articleid'].'&act=clean'.$this->_tpl_vars['jieqi_token_url'].'\';">清空小说</a> 
   
   <a class="btnlink" href="'.$this->_tpl_vars['article_dynamic_url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'">管理书评</a> 
   ';
if($this->_tpl_vars['articlevote'] > 0){
echo '
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/votenew.php?aid='.$this->_tpl_vars['articleid'].'">新建投票</a> 
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/votearticle.php?id='.$this->_tpl_vars['articleid'].'">管理投票</a>
   ';
}
echo '
   </td>
 </tr>
 <tr>
 <td>
 <ul class="am_chapters">
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
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] == 0){
echo '
 <li class="am_chapter">
 <input type="checkbox" class="checkbox" name="chapterid[]" value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" />
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterread'].'" target="_blank">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a>
 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '<em>vip</em>';
}
echo ' 
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapteredit'].'" class="am_act" title="编辑章节">[编]</a> 
 
 <!--<a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要删除该章节么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="删除章节">[删]</a>-->
 
 <a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要删除该章节么？\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'}\';" class="am_act" title="删除章节">[删]</a>
 
 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '
 <!--<a id="act_free_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要将本章节设为免费么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetfree'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="设为免费章节">[免]</a>-->

 <a id="act_free_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要将本章节设为免费么？\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetfree'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="设为免费章节">[免]</a>
 
 ';
}else{
echo '
 <!--<a id="act_vip_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要将本章节设为VIP么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetvip'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="设为VIP章节">[VIP]</a>-->

 <a id="act_vip_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要将本章节设为VIP么？\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetvip'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="设为VIP章节">[VIP]</a>
 ';
}
echo '

 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo '
 <!--<a id="act_hide_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要隐藏本章节内容么？\')) GPage.addbook(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersethide'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="隐藏章节内容">[隐]</a>-->

  <a id="act_hide_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要隐藏本章节内容么？\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersethide'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="隐藏章节内容">[隐]</a>
 ';
}else{
echo '
 <!--<a id="act_show_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要显示本章节内容么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetshow'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="显示章节内容">[显]</a>-->

  <a id="act_show_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要显示本章节内容么？\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetshow'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="显示章节内容">[显]</a>
 ';
}
echo '
 </li>
 ';
}else{
echo '
 <li class="am_volume">
 <input type="checkbox" class="checkbox" name="chapterid[]" value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" />
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterread'].'" target="_blank">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a> 
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapteredit'].'" class="am_act" title="编辑分卷">[编]</a> 
 
 <!--<a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要删除该分卷么？\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="删除分卷">[删]</a>-->

 <a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'确实要删除该分卷么？\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="删除分卷">[删]</a>
 </li>
 ';
}
echo '
 ';
}
echo '
 </ul>
 </td>
 </tr>
 <tr>
   <td class="foot">
   <input type="hidden" name="articleid" id="articleid" value="'.$this->_tpl_vars['articleid'].'" />
   <input type="button" name="allcheck" value="选择全部章节" class="button" onclick="for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = true; }">&nbsp;&nbsp;
   <input type="button" name="nocheck" value="取消全部选中" class="button" onclick="for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = false; }">&nbsp;&nbsp;
   <select class="select"  size="1" name="act" id="act" onchange="changeAction();">
  <option value="">--选择操作--</option>
  <option value="delete">批量删除章节</option>
   <option value="free">批量改为免费章节</option>
  <option value="vip">批量改为VIP章节</option>
  </select>
  '.$this->_tpl_vars['jieqi_token_input'].'
   <input type="submit" name="submit" value="确定" class="button">
   </td>
 </tr>
</form>
</table>

<br />
<table width="100%" class="grid" cellspacing="1" align="center">
<form name="chaptersort" id="chaptersort" action="'.$this->_tpl_vars['url_chaptersort'].'" method="post">
<caption>章节排序</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">选择章节或分卷：</td>
  <td class="tdr" width="75%">
  <select class="select"  size="1" name="fromid" id="fromid">
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
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] == 0){
echo '
  <option value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterorder'].'">|-'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</option>
  ';
}else{
echo '
  <option value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterorder'].'">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</option>
  ';
}
echo '
  ';
}
echo '
  </select>
  </td>
</tr>
  <tr valign="middle" align="left">
  <td class="tdl">移动到：</td>
  <td class="tdr">
  <select class="select"  size="1" name="toid" id="toid">
  <option value="0">--最前面--</option>
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
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptertype'] == 0){
echo '
  <option value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterorder'].'">|-'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</option>
  ';
}else{
echo '
  <option value="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterorder'].'">'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</option>
  ';
}
echo '
  ';
}
echo '
  </select>
  <span class="hot">之后</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">&nbsp;</td>
  <td class="tdr">
  <input type="submit" class="button" name="submit_sort"  id="submit_sort" value="确 定" />
  <input type="hidden" name="aid" id="aid" value="'.$this->_tpl_vars['articleid'].'" />
  <input type="hidden" name="act" value="sort" />'.$this->_tpl_vars['jieqi_token_input'].'
  </td>
</tr>
</form>
</table>

<br/>
<table width="100%" class="grid" cellspacing="1" align="center">
<form name="repack" id="repack" action="'.$this->_tpl_vars['url_repack'].'" method="post">
<caption>重新生成</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">生成选项</td>
  <td class="tdr" width="75%">
  <ul class="am_packflag">
  ';
if (empty($this->_tpl_vars['packflag'])) $this->_tpl_vars['packflag'] = array();
elseif (!is_array($this->_tpl_vars['packflag'])) $this->_tpl_vars['packflag'] = (array)$this->_tpl_vars['packflag'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['packflag']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['packflag']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['packflag']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['packflag']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['packflag']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <li><input type="checkbox" class="checkbox" name="packflag[]" value="'.$this->_tpl_vars['packflag'][$this->_tpl_vars['i']['key']]['value'].'" />'.$this->_tpl_vars['packflag'][$this->_tpl_vars['i']['key']]['title'].' </li>
  ';
}
echo '
  </ul>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">&nbsp;</td>
  <td class="tdr">
  <input type="submit" class="button" name="submit_repack" id="submit_repack" value="确 定" />
  <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articleid'].'" />
  <input type="hidden" name="act" value="repack" />'.$this->_tpl_vars['jieqi_token_input'].'
  </td>
</tr>
</form>
</table>
</div>
</div>';
?>