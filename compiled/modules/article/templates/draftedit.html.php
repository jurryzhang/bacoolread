<?php
echo '
<script type="text/javascript">
var customprice = \''.$this->_tpl_vars['customprice'].'\';
function frmchapteredit_validate(){
  if(document.frmchapteredit.chaptername.value == ""){
    alert("�������½ڱ���");
    document.frmchapteredit.chaptername.focus();
    return false;
  }
  if(document.frmchapteredit.chaptercontent.value == "" ){
	alert( "�������½�����" );
	document.frmchapteredit.chaptercontent.focus();
	return false;
  }
}
//ͳ����������
function show_inputsize(txt){
	txt = $_(txt);
	var size = (arguments.length > 1) ? $_(arguments[1]) : $_(txt.id + \'_size\');
	size.innerHTML = txt.value.replace(/\\s/g, \'\').length;
}
//��ʾĬ������
addEvent(window, \'load\', function(){show_inputsize(\'chaptercontent\');});
</script>
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<form name="frmchapteredit" id="frmchapteredit" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/draftedit.php?do=submit" method="post" onsubmit="return frmchapteredit_validate();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>�༭�ݸ�</caption>
<tr valign="middle" align="left">
		<td class="tdl" width="20%">';
if($this->_tpl_vars['isvip'] == 0){
echo 'С˵���ƣ�';
}else{
echo 'VIPС˵���ƣ�';
}
echo '</td>
		<td class="tdr">
		';
if($this->_tpl_vars['isvip'] == 0){
echo '
		<select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--��ѡ��--</option>
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
		<option value=\'0\'>--��ѡ��--</option>
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
  <td class="tdl">�½ڱ��⣺</td>
  <td class="tdr"><input type="text" class="text" name="chaptername" id="chaptername" size="50" maxlength="50" value="'.$this->_tpl_vars['chaptername'].'" /></td>
</tr>
';
if($this->_tpl_vars['isvip'] > 0 && $this->_tpl_vars['customprice'] > 0){
echo '
	<tr valign="middle" align="left" id="sprice">
		<td class="tdl">���¶��ۣ�</td>
		<td class="tdr"><input type=\'text\' class=\'text\' name=\'saleprice\' id=\'saleprice\' size=\'10\' maxlength=\'10\' value=\''.$this->_tpl_vars['saleprice'].'\' /><span class="hot">'.$this->_tpl_vars['egoldname'].'(�������Զ��������Ƽ�)</span></td>
	</tr>
';
}
echo '
<tr valign="middle" align="left">
		<td class="tdl">�Ƿ�ʱ����</td>
		<td class="tdr">
		<input type="radio" class="radio" name="autopub" value="0"';
if($this->_tpl_vars['pubdate'] == 0){
echo ' checked="checked"';
}
echo ' onclick="document.getElementById(\'pubtime\').style.display=\'none\';" />�� &nbsp; 
		<input type="radio" class="radio" name="autopub" value="1"';
if($this->_tpl_vars['pubdate'] > 0){
echo ' checked="checked"';
}
echo ' onclick="document.getElementById(\'pubtime\').style.display=\'\';" />�� &nbsp; 
		</td>
</tr>
<tr valign="middle" align="left" id="pubtime" ';
if($this->_tpl_vars['pubdate'] == 0){
echo 'style="display:none;"';
}
echo '>
		<td class="tdl">��ʱ����ʱ�䣺</td>
		<td class="tdr">
		<input type="text" class="text" name="pubyear" id="pubyear" size="4" maxlength="4" value="'.$this->_tpl_vars['pubyear'].'" />��<input type="text" class="text" name="pubmonth" id="pubmonth" size="2" maxlength="2" value="'.$this->_tpl_vars['pubmonth'].'" />��<input type="text" class="text" name="pubday" id="pubday" size="2" maxlength="2" value="'.$this->_tpl_vars['pubday'].'" />��<input type="text" class="text" name="pubhour" id="pubhour" size="2" maxlength="2" value="'.$this->_tpl_vars['pubhour'].'" />ʱ<input type="text" class="text" name="pubminute" id="pubminute" size="2" maxlength="2" value="'.$this->_tpl_vars['pubminute'].'" />��
		</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�½����ݣ�<br />������ <span class="hot" id="chaptercontent_size">0</span> ��</td>
  <td class="tdr"><textarea class="textarea" name="chaptercontent" id="chaptercontent" rows="25" cols="80" onkeyup="show_inputsize(this);" oninput="show_inputsize(this);" onpropertychange="show_inputsize(this);">'.$this->_tpl_vars['chaptercontent'].'</textarea></td>
</tr>
<tr valign="middle" align="left">
  <td width="25%">&nbsp;<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['id'].'" />
  <td><input type="submit" class="button" name="submit"  id="submit" value="�� ��" /></td>
</tr>
</table>
</form>
</div></div>';
?>