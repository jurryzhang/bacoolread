<?php
echo '<script type="text/javascript">
<!--
function frmgetpass_validate(){
  if(document.frmgetpass.uname.value == ""){
    alert( "�������û���" );
	document.frmgetpass.uname.focus();
	return false;
  }
  if(document.frmgetpass.email.value == ""){
    alert( "������Email" );
	document.frmgetpass.email.focus();
	return false;
  }
}
//-->
</script>
<br />
<form name="frmgetpass" id="frmgetpass" action="getpass.php?do=submit" method="post" onsubmit="return frmgetpass_validate();">
<table width="80%" class="grid" cellspacing="1" align="center">
  <caption>�������룿</caption>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">˵����</td>
    <td class="tdr" width="75%">�ύ������Ϣ������鿴�������䣬������ʾ�����ӷ��ر�վ�����趨���롣</td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl">�û�����</td>
    <td class="tdr"><input type="text" class="text" name="uname" id="uname" size="25" maxlength="30" value="" /></td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl">Email��</td>
	<td class="tdr"><input type="text" class="text" name="email" id="email" size="25" maxlength="60" value="" /></td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl">&nbsp;</td>
	<td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="�� ��" /><input type="hidden" name="action" id="action" value="sendpass" /></td>
  </tr>
</table>
</form>
<br /><br /><br /><br />';
?>