<?php
echo '<script type="text/javascript">
<!--
function frmchangeegold_validate(){
  if(typeof(document.frmchangeegold.egold) != "undefined"){
    if(document.frmchangeegold.egold.value == "" ){
      alert("请输入'.$this->_tpl_vars['egoldname'].'的值");
	  document.frmchangeegold.egold.focus();
	  return false;
    }
  }
}
//-->
</script>
<form name="frmchangeegold" id="frmchangeegold" action="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/admin/changeegold.php?do=submit" method="post" onsubmit="return frmchangeegold_validate();">
<table width="80%" class="grid" cellspacing="1" align="center">
<caption>手工充值'.$this->_tpl_vars['egoldname'].'</caption>
<tr valign="middle" align="left">
  <td class="odd" width="25%">用户名</td>
  <td class="even"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['uid']).'">'.$this->_tpl_vars['uname'].'</a> (ID: '.$this->_tpl_vars['uid'].')</td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">现有'.$this->_tpl_vars['egoldname'].'</td>
  <td class="even">'.$this->_tpl_vars['egold'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">增加'.$this->_tpl_vars['egoldname'].'</td>
  <td class="even"><input type="text" class="text" name="egold" id="egold" size="10" maxlength="11" value="" /> <span class="hottext"> 必须整数，如：12 表示增加12点'.$this->_tpl_vars['egoldname'].'，-12 表示扣除12点'.$this->_tpl_vars['egoldname'].'</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">支付金额</td>
  <td class="even"><input type="text" class="text" name="money" id="money" size="10" maxlength="11" value="" /> 元 <span class="hottext">如果是用户汇款购买'.$this->_tpl_vars['egoldname'].'，这里输入金额，否则可以留空</span></td>
</tr>
<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="uid" id="uid" value="'.$this->_tpl_vars['uid'].'" /><tr valign="middle" align="left">
  <td class="odd" width="25%">&nbsp;</td>
  <td class="even"><input type="submit" class="button" name="submit"  id="submit" value="提 交" /></td>
</tr>
</table>
</form>';
?>