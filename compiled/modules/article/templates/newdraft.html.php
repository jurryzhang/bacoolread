<?php
echo '
<script type="text/javascript">
var customprice = \''.$this->_tpl_vars['customprice'].'\';
function frmnewdraft_validate(){
  if(document.frmnewdraft.chaptername.value == ""){
    alert("�������½ڱ���");
    document.frmnewdraft.chaptername.focus();
    return false;
  }
  if(document.frmnewdraft.chaptercontent.value == "" ){
	alert( "�������½�����" );
	document.frmnewdraft.chaptercontent.focus();
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
<form name="frmnewdraft" id="frmnewdraft" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/newdraft.php?do=submit" method="post" onsubmit="return frmnewdraft_validate();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>�½��ݸ�</caption>
<tr valign="middle" align="left">
	<td class="tdl" width=\'20%\'>�ݸ����ͣ�</td>
	<td class="tdr">
	<input type="radio" class="radio" name=\'isvip\' value=\'0\' checked="checked" onclick="document.getElementById(\'selarticle\').style.display=\'block\';document.getElementById(\'selobook\').style.display=\'none\';if(customprice == \'1\') document.getElementById(\'sprice\').style.display=\'none\';" />����½� &nbsp; 
	<input type="radio" class="radio" name=\'isvip\' value=\'1\' onclick="document.getElementById(\'selarticle\').style.display=\'none\';document.getElementById(\'selobook\').style.display=\'block\';if(customprice == \'1\') document.getElementById(\'sprice\').style.display=\'\';" />VIP�½� &nbsp; 
	</td>
  </tr>
<tr valign="middle" align="left">
  <td class="tdl">С˵���ƣ�</td>
  <td class="tdr">
		<div id="selarticle" style="display:block;">
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
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>
		';
}
echo '
		</select>
		</div>
		<div id="selobook" style="display:none;">
		<select class=\'select\'  size=\'1\' name=\'obookid\' id=\'obookid\'>
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
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>
		';
}
echo '
		';
}
echo '
		</select>
		</div>
  </td>
</tr><tr valign="middle" align="left">
  <td class="tdl">�½ڱ��⣺</td>
  <td class="tdr"><input type="text" class="text" name="chaptername" id="chaptername" size="50" maxlength="50" value="" /></td>
</tr>
';
if($this->_tpl_vars['customprice'] > 0){
echo '
<tr valign="middle" align="left" id="sprice" style="display:none;">
	<td class="tdl">���¶��ۣ�</td>
	<td class="tdr"><input type="text" class="text" name="saleprice" id="saleprice" size="10" maxlength="10" value="" /><span class="hot">'.$this->_tpl_vars['egoldname'].'(�������Զ��������Ƽ�)</span></td>
</tr>
';
}
if($this->_tpl_vars['authtypeset'] > 0){
echo '
<tr valign="middle" align="left">
  <td class="tdl">С˵�Ű棺</td>
  <td class="tdr"><input type="radio" class="radio" name="typeset" value="1" checked="checked" />�Զ��Ű�
<input type="radio" class="radio" name="typeset" value="0" />�����Ű�
</td>
</tr>
';
}
echo '
<tr valign="middle" align="left">
	<td class="tdl">�Ƿ�ʱ����</td>
	<td class="tdr">
	<input type="radio" class="radio" name="autopub" value="0" checked="checked" onclick="document.getElementById(\'pubtime\').style.display=\'none\';" />�� &nbsp; 
	<input type="radio" class="radio" name="autopub" value="1" onclick="document.getElementById(\'pubtime\').style.display=\'\';" />�� &nbsp; 
	</td>
</tr>
<tr valign="middle" align="left" id="pubtime" style="display:none;">
	<td class="tdl">��ʱ����ʱ�䣺</td>
	<td class="tdr">
	<input type="text" class="text" name="pubyear" id="pubyear" size="4" maxlength="4" value="'.date('Y',$this->_tpl_vars['jieqi_time']).'" />��<input type="text" class="text" name="pubmonth" id="pubmonth" size="2" maxlength="2" value="'.date('m',$this->_tpl_vars['jieqi_time']).'" />��<input type="text" class="text" name="pubday" id="pubday" size="2" maxlength="2" value="'.date('d',$this->_tpl_vars['jieqi_time']).'" />��<input type="text" class="text" name="pubhour" id="pubhour" size="2" maxlength="2" value="" />ʱ<input type="text" class="text" name="pubminute" id="pubminute" size="2" maxlength="2" value="" />��
	</td>
</tr><tr valign="middle" align="left">
  <td class="tdl">�½����ݣ�<br />������ <span class="hot" id="chaptercontent_size">0</span> ��</td>
  <td class="tdr"><textarea class="textarea" name="chaptercontent" id="chaptercontent" rows="25" cols="80" onkeyup="show_inputsize(this);" oninput="show_inputsize(this);" onpropertychange="show_inputsize(this);"></textarea></td>
</tr>
<tr valign="middle" align="left">
  <td width="25%">&nbsp;<input type="hidden" name="action" id="action" value="newdraft" /></td>
  <td><input type="submit" class="button" name="submit"  id="submit" value="�� ��" />';
if($this->_tpl_vars['needupaudit'] > 0){
echo '&nbsp;&nbsp;<span class="hot">ע�⣺�½��ݸ���½�Ҳ���ȱ����ڲݸ�������½��б��У�����Ա��˺����������ʾ��</span>';
}
echo '</td>
</tr>
</table>
</form>
</div></div>';
?>