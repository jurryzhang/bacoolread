<?php
echo '<script type="text/javascript">
<!--
function jieqiFormValidate_usermanage(){
  if(document.usermanage.groupid.value == ""){
    alert("请输入等级");
    document.usermanage.groupid.focus();
    return false;
  }
}
//-->
</script>
<form name="usermanage" id="usermanage" action="'.$this->_tpl_vars['jieqi_url'].'/admin/usermanage.php?do=submit" method="post" onsubmit="return jieqiFormValidate_usermanage();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>用户管理</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">用户名：</td>
  <td class="tdr">'.$this->_tpl_vars['username'].' ('.$this->_tpl_vars['nickname'].')</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">密码：</td>
  <td class="tdr"><input type="password" class="text" name="pass" id="pass" size="25" maxlength="20" value="" /> <span class="hottext">（不修改密码请留空）</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">确认密码：<span class="hottext">(必填)</span></td>
  <td class="tdr"><input type="password" class="text" name="repass" id="repass" size="25" maxlength="20" value="" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">等级：</td>
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
  <td class="tdl" width="25%">经验值：</td>
  <td class="tdr"><input type="text" class="text" name="experience" id="experience" size="25" maxlength="11" value="'.$this->_tpl_vars['uservals']['experience'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">积分：</td>
  <td class="tdr"><input type="text" class="text" name="score" id="score" size="25" maxlength="11" value="'.$this->_tpl_vars['uservals']['score'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">VIP类型：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="isvip" value="0"';
if($this->_tpl_vars['uservals']['isvip'] == 0){
echo ' checked="checked"';
}
echo ' />非VIP会员
  <input type="radio" class="radio" name="isvip" value="1"';
if($this->_tpl_vars['uservals']['isvip'] > 0){
echo ' checked="checked"';
}
echo ' />VIP会员
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">'.$this->_tpl_vars['egoldname'].'：</td>
  <td class="tdr"><input type="text" class="text" name="egold" id="egold" size="25" maxlength="11" value="'.$this->_tpl_vars['uservals']['egold'].'"/></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">删除用户：</td>
  <td class="tdr"><input type="radio" class="radio" name="deluser" value="0" checked="checked" />否
<input type="radio" class="radio" name="deluser" value="1" />是
</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">修改理由：</td>
  <td class="tdr"><textarea class="textarea" name="reason" id="reason" rows="6" cols="60"></textarea></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['uservals']['uid'].'" /></td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="保存修改" /></td>
</tr>
</table>
</form>';
?>