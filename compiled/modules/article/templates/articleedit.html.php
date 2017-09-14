<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="/sink/jedate/skin/jedate.css">
<script type="text/javascript" src="/sink/jedate/jquery-1.7.2.js"></script>
<script type="text/javascript" src="/sink/jedate/jquery.jedate.js"></script>
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<script type="text/javascript">
<!--
function frmarticleedit_validate(){
  if(document.frmarticleedit.sortid.value == ""){
    alert("请输入类别");
    document.frmarticleedit.sortid.focus();
    return false;
  }
  if(document.frmarticleedit.articlename.value == ""){
    alert("请输入小说名称");
    document.frmarticleedit.articlename.focus();
    return false;
  }
}
function showsorts(obj){
    var sortselect = document.getElementById(\'sortselect\');
    sortselect.innerHTML = \'\';
	typeselect.innerHTML = \'\';
    ';
if (empty($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = array();
elseif (!is_array($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = (array)$this->_tpl_vars['rgroup']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['rgroup']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['rgroup']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['rgroup']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	  if(obj.options[obj.selectedIndex].value == '.$this->_tpl_vars['i']['key'].') sortselect.innerHTML = \'<select class="select" size="1" onchange="showtypes(this)" name="sortid" id="sortid">';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	if($this->_tpl_vars['sortrows'][$this->_tpl_vars['j']['key']]['group'] == $this->_tpl_vars['i']['key']){
echo '<option value="'.$this->_tpl_vars['j']['key'].'"';
if($this->_tpl_vars['j']['key'] == $this->_tpl_vars['articlevals']['sortid']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['j']['key']]['caption'].'</option>';
}
}
echo '</select>\';
    ';
}
echo '
}

function showtypes(obj){
    var typeselect=document.getElementById(\'typeselect\');
    typeselect.innerHTML=\'\';
    ';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	  ';
if($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] != ''){
echo '
	  if(obj.options[obj.selectedIndex].value == '.$this->_tpl_vars['i']['key'].') typeselect.innerHTML=\'<select class="select" size="1" name="typeid" id="typeid">';
if (empty($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = (array)$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '<option value="'.$this->_tpl_vars['j']['key'].'"';
if($this->_tpl_vars['j']['key'] == $this->_tpl_vars['articlevals']['typeid']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']].'</option>';
}
echo '</select>\';
	  ';
}
echo '
    ';
}
echo '
  }
//-->
</script>
<form name="frmarticleedit" id="frmarticleedit" action="'.$this->_tpl_vars['url_articleedit'].'" method="post" onsubmit="return frmarticleedit_validate();" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>编辑小说</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">类别：</td>
  <td class="tdr">
  <select class="select" size="1" onchange="showsorts(this)" name="rgroupid" id="rgroupid">
  ';
if (empty($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = array();
elseif (!is_array($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = (array)$this->_tpl_vars['rgroup']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['rgroup']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['rgroup']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['rgroup']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <option value="'.$this->_tpl_vars['i']['key'].'"';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['rgroup_n']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['rgroup']['items'][$this->_tpl_vars['i']['key']].' </option>
  ';
}
echo '
  </select>
  <span id="sortselect" name="sortselect"></span>
  <span id="typeselect" name="typeselect"></span>
  <script type="text/javascript">
  showsorts(document.getElementById(\'rgroupid\'));
  showtypes(document.getElementById(\'sortid\'));
  </script>
  
  </td>
</tr><tr valign="middle" align="left">
  <td class="tdl">小说名称：</td>
  <td class="tdr"><input type="text" class="text" name="articlename" id="articlename" size="30" maxlength="50" value="'.$this->_tpl_vars['articlevals']['articlename'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">副标题（可不填）：</td>
  <td class="tdr"><input type="text" class="text" name="backupname" id="backupname" size="30" maxlength="100" value="'.$this->_tpl_vars['articlevals']['backupname'].'" /> <span class="hot">一句话简介</span></td>
</tr><tr valign="middle" align="left">
  <td class="tdl">关键字：</td>
  <td class="tdr"><input type="text" class="text" name="keywords" id="keywords" size="30" maxlength="50" value="'.$this->_tpl_vars['articlevals']['keywords'].'" /> <span class="hottext">主角姓名,特定名词等,以空格分隔</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">责编：</td>
  <td class="tdr"><input type="text" class="text" name="agent" id="agent" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['agent'].'" /> <span class="hottext">可以指定一个本站现有编辑作为责编</span></td>
</tr>
';
if($this->_tpl_vars['allowtrans'] > 0){
echo '
<tr valign="middle" align="left">
  <td class="tdl">作者笔名：</td>
  <td class="tdr"><input type="text" class="text" name="author" id="author" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['author'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">作者绑定：</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['authorflag']['items'])) $this->_tpl_vars['authorflag']['items'] = array();
elseif (!is_array($this->_tpl_vars['authorflag']['items'])) $this->_tpl_vars['authorflag']['items'] = (array)$this->_tpl_vars['authorflag']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['authorflag']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['authorflag']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['authorflag']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['authorflag']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['authorflag']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="authorflag" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['authorflag']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['authorflag']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
</td>
</tr>
';
}
echo '
<tr valign="middle" align="left">
  <td class="tdl">授权级别：</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['permission']['items'])) $this->_tpl_vars['permission']['items'] = array();
elseif (!is_array($this->_tpl_vars['permission']['items'])) $this->_tpl_vars['permission']['items'] = (array)$this->_tpl_vars['permission']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['permission']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['permission']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['permission']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['permission']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['permission']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="permission" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['permission']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['permission']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">首发状态：</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['firstflag']['items'])) $this->_tpl_vars['firstflag']['items'] = array();
elseif (!is_array($this->_tpl_vars['firstflag']['items'])) $this->_tpl_vars['firstflag']['items'] = (array)$this->_tpl_vars['firstflag']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['firstflag']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['firstflag']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['firstflag']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['firstflag']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['firstflag']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="firstflag" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['firstflag']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['firstflag']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">写作进度：</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['fullflag']['items'])) $this->_tpl_vars['fullflag']['items'] = array();
elseif (!is_array($this->_tpl_vars['fullflag']['items'])) $this->_tpl_vars['fullflag']['items'] = (array)$this->_tpl_vars['fullflag']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['fullflag']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['fullflag']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['fullflag']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['fullflag']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['fullflag']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="fullflag" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['articlevals']['fullflag']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['fullflag']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
</td>
</tr>
<!--增加千字/币-->
<tr valign="middle" align="left">
  <td class="tdl">千字/币：</td>
  <td class="tdr"><input type="text" class="text" name="peregold" id="peregold" size="5" maxlength="3" value="'.$this->_tpl_vars['articlevals']['peregold'].'" /></td>
</tr>

<tr valign="middle" align="left">
  <td class="tdl">限时免费：</td>
  <td class="tdr"><input type="text" class="text" name="freetime" id="freetime" size="15" maxlength="50" value="';
if($this->_tpl_vars['articlevals']['freetime']!=0){
echo date('Y-m-d H:i:s',$this->_tpl_vars['articlevals']['freetime']);
}
echo '" /></td>
</tr>

<tr valign="middle" align="left">
  <td class="tdl">内容简介：</td>
  <td class="tdr"><textarea class="textarea" name="intro" id="intro" rows="8" cols="70">'.$this->_tpl_vars['articlevals']['intro'].'</textarea></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">本书公告：</td>
  <td class="tdr"><textarea class="textarea" name="notice" id="notice" rows="8" cols="70">'.$this->_tpl_vars['articlevals']['notice'].'</textarea></td>
</tr>
';
if($this->_tpl_vars['eachlinknum'] > 0){
echo '
<tr valign="middle" align="left">
  <td class="tdl">推荐小说ID（互换链接）：</td>
  <td class="tdr"><input type="text" class="text" name="eachlinkids" id="eachlinkids" size="30" maxlength="500" value="'.$this->_tpl_vars['articlevals']['eachlinkids'].'" /> <span class="hottext">必须是本站小说ID，最多'.$this->_tpl_vars['eachlinknum'].'个，用空格分开</span></td>
</tr>
';
}
echo '
<tr valign="middle" align="left">
  <td class="tdl">封面小图：</td>
  <td class="tdr"><input type="file" class="text" size="30" name="articlespic" id="articlespic" /> <span class="hottext">图片格式：600*750.jpg （须带网站logo）'.$this->_tpl_vars['imagetype'].'</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">封面大图：</td>
  <td class="tdr"><input type="file" class="text" size="30" name="articlelpic" id="articlelpic" /> <span class="hottext">图片格式：905*500.jpg （须带网站logo）'.$this->_tpl_vars['imagetype'].'</span></td>
</tr>
';
if($this->_tpl_vars['allowmodify'] > 0){
echo '
<tr>
  <td colspan="2" class="head">管理员修改选项</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">发表者：</td>
  <td class="tdr"><input type="text" class="text" name="poster" id="poster" size="30" maxlength="30" value="'.$this->_tpl_vars['articlevals']['poster'].'" /> <span class="hottext">必须是本站会员名称</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">点击数：</td>
  <td class="tdr">
  日：<input type="text" class="text" name="dayvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayvisit'].'" />
  周：<input type="text" class="text" name="weekvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekvisit'].'" />
  月：<input type="text" class="text" name="monthvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthvisit'].'" />
  总：<input type="text" class="text" name="allvisit" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allvisit'].'" />
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">推荐数：</td>
  <td class="tdr">
  日：<input type="text" class="text" name="dayvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['dayvote'].'" />
  周：<input type="text" class="text" name="weekvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['weekvote'].'" />
  月：<input type="text" class="text" name="monthvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['monthvote'].'" />
  总：<input type="text" class="text" name="allvote" size="10" maxlength="10" value="'.$this->_tpl_vars['articlevals']['allvote'].'" />
  </td>
</tr>
';
}
echo '
<tr valign="middle" align="left">
  <td class="tdl">&nbsp;<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articlevals']['articleid'].'" /></td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="提 交" /></td>
</tr>
</table>
</form>
</div></div>

<script type="text/javascript">
	$("#freetime").jeDate({
	skinCell:"jedatered",
    isinitVal:false,
    ishmsVal:false,
    maxDate: \'2099-06-16 23:59:59\',
    format:"YYYY-MM-DD hh:mm:ss",
    zIndex:3000,
});
	
</script>';
?>