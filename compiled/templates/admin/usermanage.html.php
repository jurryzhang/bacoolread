<?php
echo '<script type="text/javascript">
<!--
function jieqiFormValidate_usermanage(){
  if(document.usermanage.groupid.value == ""){
    alert("������ȼ�");
    document.usermanage.groupid.focus();
    return false;
  }
}
//-->
</script>
<form name="usermanage" id="usermanage" action="'.$this->_tpl_vars['jieqi_url'].'/admin/usermanage.php?do=submit" method="post" onsubmit="return jieqiFormValidate_usermanage();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>�û�����</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�û�����</td>
  <td class="tdr">'.$this->_tpl_vars['username'].' ('.$this->_tpl_vars['nickname'].')</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">���룺</td>
  <td class="tdr"><input type="password" class="text" name="pass" id="pass" size="25" maxlength="20" value="" /> <span class="hottext">�����޸����������գ�</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">ȷ�����룺<span class="hottext">(����)</span></td>
  <td class="tdr"><input type="password" class="text" name="repass" id="repass" size="25" maxlength="20" value="" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�ȼ���</td>
  <td class="tdr">
  <select class="select"  size="1" name="groupid" id="groupid">
  ';
if (empty($this->_tpl_vars['grouprows'])) $this->_tpl_vars['grouprows'] = array();
elseif (!is_array($this->_tpl_vars['grouprows'])) $this->_tpl_vars['grouprows'] = (array)$this->_tpl_vars['grouprows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['grouprows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['grouprows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['grouprows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['grouprows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['grouprows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <option value="'.$this->_tpl_vars['i']['key'].'"';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['uservals']['groupid']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['grouprows'][$this->_tpl_vars['i']['key']].'</option>
  ';
}
echo '
  </select>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">����ֵ��</td>
  <td class="tdr"><input type="text" class="text" name="experience" id="experience" size="25" maxlength="11" value="'.$this->_tpl_vars['uservals']['experience'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">���֣�</td>
  <td class="tdr"><input type="text" class="text" name="score" id="score" size="25" maxlength="11" value="'.$this->_tpl_vars['uservals']['score'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">VIP���ͣ�</td>
  <td class="tdr">
  <input type="radio" class="radio" name="isvip" value="0"';
if($this->_tpl_vars['uservals']['isvip'] == 0){
echo ' checked="checked"';
}
echo ' />��VIP��Ա
  <input type="radio" class="radio" name="isvip" value="1"';
if($this->_tpl_vars['uservals']['isvip'] > 0){
echo ' checked="checked"';
}
echo ' />VIP��Ա
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">'.$this->_tpl_vars['egoldname'].'��</td>
  <td class="tdr"><input type="text" class="text" name="egold" id="egold" size="25" maxlength="11" value="'.$this->_tpl_vars['uservals']['egold'].'"/></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">ɾ���û���</td>
  <td class="tdr"><input type="radio" class="radio" name="deluser" value="0" checked="checked" />��
<input type="radio" class="radio" name="deluser" value="1" />��
</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�޸����ɣ�</td>
  <td class="tdr"><textarea class="textarea" name="reason" id="reason" rows="6" cols="60"></textarea></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['uservals']['uid'].'" /></td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="�����޸�" /></td>
</tr>
</table>
</form>';
?>