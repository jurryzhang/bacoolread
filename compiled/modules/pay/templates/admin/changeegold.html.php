<?php
echo '<script type="text/javascript">
<!--
function frmchangeegold_validate(){
  if(typeof(document.frmchangeegold.egold) != "undefined"){
    if(document.frmchangeegold.egold.value == "" ){
      alert("������'.$this->_tpl_vars['egoldname'].'��ֵ");
	  document.frmchangeegold.egold.focus();
	  return false;
    }
  }
}
//-->
</script>
<form name="frmchangeegold" id="frmchangeegold" action="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/admin/changeegold.php?do=submit" method="post" onsubmit="return frmchangeegold_validate();">
<table width="80%" class="grid" cellspacing="1" align="center">
<caption>�ֹ���ֵ'.$this->_tpl_vars['egoldname'].'</caption>
<tr valign="middle" align="left">
  <td class="odd" width="25%">�û���</td>
  <td class="even"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['uid']).'">'.$this->_tpl_vars['uname'].'</a> (ID: '.$this->_tpl_vars['uid'].')</td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">����'.$this->_tpl_vars['egoldname'].'</td>
  <td class="even">'.$this->_tpl_vars['egold'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">����'.$this->_tpl_vars['egoldname'].'</td>
  <td class="even"><input type="text" class="text" name="egold" id="egold" size="10" maxlength="11" value="" /> <span class="hottext"> �����������磺12 ��ʾ����12��'.$this->_tpl_vars['egoldname'].'��-12 ��ʾ�۳�12��'.$this->_tpl_vars['egoldname'].'</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">֧�����</td>
  <td class="even"><input type="text" class="text" name="money" id="money" size="10" maxlength="11" value="" /> Ԫ <span class="hottext">������û�����'.$this->_tpl_vars['egoldname'].'����������������������</span></td>
</tr>
<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="uid" id="uid" value="'.$this->_tpl_vars['uid'].'" /><tr valign="middle" align="left">
  <td class="odd" width="25%">&nbsp;</td>
  <td class="even"><input type="submit" class="button" name="submit"  id="submit" value="�� ��" /></td>
</tr>
</table>
</form>';
?>