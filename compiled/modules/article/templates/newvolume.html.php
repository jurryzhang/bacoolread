<?php
echo '
<script type="text/javascript">
<!--
function frmnewvolume_validate(){
  if(document.frmnewvolume.chaptername.value == ""){
    alert("请输入新增分卷");
    document.frmnewvolume.chaptername.focus();
    return false;
  }
}
//-->
</script>
<form name="frmnewvolume" id="frmnewvolume" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/newvolume.php?do=submit" method="post" onsubmit="return frmnewvolume_validate();">
<table width="80%" class="grid" cellspacing="1" align="center">
<caption>增加分卷</caption>
<tr valign="middle" align="left">
  <td width="25%">小说名称</td>
  <td><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlemanage.php?id='.$this->_tpl_vars['articleid'].'">'.$this->_tpl_vars['articlename'].'</a></td>
</tr>
<tr valign="middle" align="left">
  <td width="25%">现有分卷</td>
  <td>
  ';
if (empty($this->_tpl_vars['volumerows'])) $this->_tpl_vars['volumerows'] = array();
elseif (!is_array($this->_tpl_vars['volumerows'])) $this->_tpl_vars['volumerows'] = (array)$this->_tpl_vars['volumerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['volumerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['volumerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['volumerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['volumerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['volumerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  '.$this->_tpl_vars['volumerows'][$this->_tpl_vars['i']['key']]['chaptername'].'<br />
  ';
}
echo '
  </td>
</tr>
<tr valign="middle" align="left">
  <td width="25%">新增分卷</td>
  <td><input type="text" class="text" name="chaptername" id="chaptername" size="50" maxlength="50" value="" /></td>
</tr>
<tr valign="middle" align="left">
  <td width="25%">&nbsp;<input type="hidden" name="action" id="action" value="newvolume" /><input type="hidden" name="aid" id="aid" value="'.$this->_tpl_vars['articleid'].'" /></td>
  <td><input type="submit" class="button" name="submit"  id="submit" value="提 交" /></td>
</tr>
</table>
</form>';
?>