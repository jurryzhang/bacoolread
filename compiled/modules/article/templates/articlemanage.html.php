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
                                //Ĭ����login.action����select�ı�ʱͬʱ�ı�from��action����
                                //������ֱ�Ӱ��б��value��ֵ��form��action������Ը�����Ҫ�ĸ�
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
 <caption>��'.$this->_tpl_vars['articlename'].'��[<a href="'.$this->_tpl_vars['url_articleinfo'].'" target="_blank">��Ϣ</a>] [<a href="'.$this->_tpl_vars['url_articleindex'].'" target="_blank">�Ķ�</a>]</caption>
 <tr>
   <td align="center" class="head">
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/newvolume.php?aid='.$this->_tpl_vars['articleid'].'">�½��־�</a> 
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/newchapter.php?aid='.$this->_tpl_vars['articleid'].'">�����½�</a> 
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/articleedit.php?id='.$this->_tpl_vars['articleid'].'">�༭С˵</a> 
   <!-- burn 2016-12-6 modify -->
   <!--<a class="btnlink" id="act_delete" href="javascript:;" onclick="if(confirm(\'ȷʵҪɾ����С˵ô��\')) Ajax.Tip(\''.$this->_tpl_vars['article_static_url'].'/articledel.php?id='.$this->_tpl_vars['articleid'].'&act=delete'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});">ɾ��С˵</a>-->
   
   <a class="btnlink" id="act_delete" href="javascript:;" onclick="if(confirm(\'ȷʵҪɾ����С˵ô��\')) href=\''.$this->_tpl_vars['article_static_url'].'/articledel.php?id='.$this->_tpl_vars['articleid'].'&act=delete'.$this->_tpl_vars['jieqi_token_url'].'\';">ɾ��С˵</a>
   
   <!--<a class="btnlink" id="act_delete" href="javascript:;" onclick="if(confirm(\'ȷʵҪ��գ�ɾ�������½ڣ���С˵ô��\')) Ajax.Tip(\''.$this->_tpl_vars['article_static_url'].'/articleclean.php?id='.$this->_tpl_vars['articleid'].'&act=clean'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});">���С˵</a> -->
   
   <a class="btnlink" id="act_delete" href="javascript:;" onclick="if(confirm(\'ȷʵҪ��գ�ɾ�������½ڣ���С˵ô��\')) href=\''.$this->_tpl_vars['article_static_url'].'/articleclean.php?id='.$this->_tpl_vars['articleid'].'&act=clean'.$this->_tpl_vars['jieqi_token_url'].'\';">���С˵</a> 
   
   <a class="btnlink" href="'.$this->_tpl_vars['article_dynamic_url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'">��������</a> 
   ';
if($this->_tpl_vars['articlevote'] > 0){
echo '
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/votenew.php?aid='.$this->_tpl_vars['articleid'].'">�½�ͶƱ</a> 
   <a class="btnlink" href="'.$this->_tpl_vars['article_static_url'].'/votearticle.php?id='.$this->_tpl_vars['articleid'].'">����ͶƱ</a>
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
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapteredit'].'" class="am_act" title="�༭�½�">[��]</a> 
 
 <!--<a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪɾ�����½�ô��\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="ɾ���½�">[ɾ]</a>-->
 
 <a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪɾ�����½�ô��\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'}\';" class="am_act" title="ɾ���½�">[ɾ]</a>
 
 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '
 <!--<a id="act_free_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪ�����½���Ϊ���ô��\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetfree'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="��Ϊ����½�">[��]</a>-->

 <a id="act_free_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪ�����½���Ϊ���ô��\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetfree'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="��Ϊ����½�">[��]</a>
 
 ';
}else{
echo '
 <!--<a id="act_vip_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪ�����½���ΪVIPô��\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetvip'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="��ΪVIP�½�">[VIP]</a>-->

 <a id="act_vip_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪ�����½���ΪVIPô��\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetvip'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="��ΪVIP�½�">[VIP]</a>
 ';
}
echo '

 ';
if($this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo '
 <!--<a id="act_hide_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪ���ر��½�����ô��\')) GPage.addbook(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersethide'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="�����½�����">[��]</a>-->

  <a id="act_hide_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪ���ر��½�����ô��\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersethide'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="�����½�����">[��]</a>
 ';
}else{
echo '
 <!--<a id="act_show_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪ��ʾ���½�����ô��\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetshow'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="��ʾ�½�����">[��]</a>-->

  <a id="act_show_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪ��ʾ���½�����ô��\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chaptersetshow'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="��ʾ�½�����">[��]</a>
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
 <a href="'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapteredit'].'" class="am_act" title="�༭�־�">[��]</a> 
 
 <!--<a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪɾ���÷־�ô��\')) Ajax.Tip(\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});" class="am_act" title="ɾ���־�">[ɾ]</a>-->

 <a id="act_delete_'.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['chapterid'].'" href="javascript:;" onclick="if(confirm(\'ȷʵҪɾ���÷־�ô��\')) href=\''.$this->_tpl_vars['chapterrows'][$this->_tpl_vars['i']['key']]['url_chapterdelete'].$this->_tpl_vars['jieqi_token_url'].'\';" class="am_act" title="ɾ���־�">[ɾ]</a>
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
   <input type="button" name="allcheck" value="ѡ��ȫ���½�" class="button" onclick="for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = true; }">&nbsp;&nbsp;
   <input type="button" name="nocheck" value="ȡ��ȫ��ѡ��" class="button" onclick="for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = false; }">&nbsp;&nbsp;
   <select class="select"  size="1" name="act" id="act" onchange="changeAction();">
  <option value="">--ѡ�����--</option>
  <option value="delete">����ɾ���½�</option>
   <option value="free">������Ϊ����½�</option>
  <option value="vip">������ΪVIP�½�</option>
  </select>
  '.$this->_tpl_vars['jieqi_token_input'].'
   <input type="submit" name="submit" value="ȷ��" class="button">
   </td>
 </tr>
</form>
</table>

<br />
<table width="100%" class="grid" cellspacing="1" align="center">
<form name="chaptersort" id="chaptersort" action="'.$this->_tpl_vars['url_chaptersort'].'" method="post">
<caption>�½�����</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">ѡ���½ڻ�־�</td>
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
  <td class="tdl">�ƶ�����</td>
  <td class="tdr">
  <select class="select"  size="1" name="toid" id="toid">
  <option value="0">--��ǰ��--</option>
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
  <span class="hot">֮��</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">&nbsp;</td>
  <td class="tdr">
  <input type="submit" class="button" name="submit_sort"  id="submit_sort" value="ȷ ��" />
  <input type="hidden" name="aid" id="aid" value="'.$this->_tpl_vars['articleid'].'" />
  <input type="hidden" name="act" value="sort" />'.$this->_tpl_vars['jieqi_token_input'].'
  </td>
</tr>
</form>
</table>

<br/>
<table width="100%" class="grid" cellspacing="1" align="center">
<form name="repack" id="repack" action="'.$this->_tpl_vars['url_repack'].'" method="post">
<caption>��������</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">����ѡ��</td>
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
  <input type="submit" class="button" name="submit_repack" id="submit_repack" value="ȷ ��" />
  <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articleid'].'" />
  <input type="hidden" name="act" value="repack" />'.$this->_tpl_vars['jieqi_token_input'].'
  </td>
</tr>
</form>
</table>
</div>
</div>';
?>