<?php
echo '
<script type="text/javascript">
var customprice = \''.$this->_tpl_vars['customprice'].'\';
function frmchapteredit_validate(){
  if(document.frmchapteredit.chaptername.value == ""){
    alert("请输入章节标题");
    document.frmchapteredit.chaptername.focus();
    return false;
  }
  if(document.frmchapteredit.chaptercontent.value == "" ){
	alert( "请输入章节内容" );
	document.frmchapteredit.chaptercontent.focus();
	return false;
  }
}
//统计输入字数
function show_inputsize(txt){
	txt = $_(txt);
	var size = (arguments.length > 1) ? $_(arguments[1]) : $_(txt.id + \'_size\');
	size.innerHTML = txt.value.replace(/\\s/g, \'\').length;
}
//显示默认字数
addEvent(window, \'load\', function(){show_inputsize(\'chaptercontent\');});
</script>
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<form name="frmchapteredit" id="frmchapteredit" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/draftedit.php?do=submit" method="post" onsubmit="return frmchapteredit_validate();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>编辑草稿</caption>
<tr valign="middle" align="left">
		<td class="tdl" width="20%">';
if($this->_tpl_vars['isvip'] == 0){
echo '小说名称：';
}else{
echo 'VIP小说名称：';
}
echo '</td>
		<td class="tdr">
		';
if($this->_tpl_vars['isvip'] == 0){
echo '
		<select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--请选择--</option>
		';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['checked'] > 0){
echo ' selected';
}
echo '>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>
		';
}
echo '
		</select>
		';
}else{
echo '
		<select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--请选择--</option>
		';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip'] > 0){
echo '
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['checked'] > 0){
echo ' selected';
}
echo '>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>
		';
}
echo '
		';
}
echo '
		</select>
		';
}
echo '
		</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">章节标题：</td>
  <td class="tdr"><input type="text" class="text" name="chaptername" id="chaptername" size="50" maxlength="50" value="'.$this->_tpl_vars['chaptername'].'" /></td>
</tr>
';
if($this->_tpl_vars['isvip'] > 0 && $this->_tpl_vars['customprice'] > 0){
echo '
	<tr valign="middle" align="left" id="sprice">
		<td class="tdl">本章定价：</td>
		<td class="tdr"><input type=\'text\' class=\'text\' name=\'saleprice\' id=\'saleprice\' size=\'10\' maxlength=\'10\' value=\''.$this->_tpl_vars['saleprice'].'\' /><span class="hot">'.$this->_tpl_vars['egoldname'].'(留空则自动按字数计价)</span></td>
	</tr>
';
}
echo '
<tr valign="middle" align="left">
		<td class="tdl">是否定时发表：</td>
		<td class="tdr">
		<input type="radio" class="radio" name="autopub" value="0"';
if($this->_tpl_vars['pubdate'] == 0){
echo ' checked="checked"';
}
echo ' onclick="document.getElementById(\'pubtime\').style.display=\'none\';" />否 &nbsp; 
		<input type="radio" class="radio" name="autopub" value="1"';
if($this->_tpl_vars['pubdate'] > 0){
echo ' checked="checked"';
}
echo ' onclick="document.getElementById(\'pubtime\').style.display=\'\';" />是 &nbsp; 
		</td>
</tr>
<tr valign="middle" align="left" id="pubtime" ';
if($this->_tpl_vars['pubdate'] == 0){
echo 'style="display:none;"';
}
echo '>
		<td class="tdl">定时发表时间：</td>
		<td class="tdr">
		<input type="text" class="text" name="pubyear" id="pubyear" size="4" maxlength="4" value="'.$this->_tpl_vars['pubyear'].'" />年<input type="text" class="text" name="pubmonth" id="pubmonth" size="2" maxlength="2" value="'.$this->_tpl_vars['pubmonth'].'" />月<input type="text" class="text" name="pubday" id="pubday" size="2" maxlength="2" value="'.$this->_tpl_vars['pubday'].'" />日<input type="text" class="text" name="pubhour" id="pubhour" size="2" maxlength="2" value="'.$this->_tpl_vars['pubhour'].'" />时<input type="text" class="text" name="pubminute" id="pubminute" size="2" maxlength="2" value="'.$this->_tpl_vars['pubminute'].'" />分
		</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">章节内容：<br />已输入 <span class="hot" id="chaptercontent_size">0</span> 字</td>
  <td class="tdr"><textarea class="textarea" name="chaptercontent" id="chaptercontent" rows="25" cols="80" onkeyup="show_inputsize(this);" oninput="show_inputsize(this);" onpropertychange="show_inputsize(this);">'.$this->_tpl_vars['chaptercontent'].'</textarea></td>
</tr>
<tr valign="middle" align="left">
  <td width="25%">&nbsp;<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['id'].'" />
  <td><input type="submit" class="button" name="submit"  id="submit" value="提 交" /></td>
</tr>
</table>
</form>
</div></div>';
?>