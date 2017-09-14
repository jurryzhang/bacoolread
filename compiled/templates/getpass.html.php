<?php
echo '<script type="text/javascript">
<!--
function frmgetpass_validate(){
  if(document.frmgetpass.uname.value == ""){
    alert( "请输入用户名" );
	document.frmgetpass.uname.focus();
	return false;
  }
  if(document.frmgetpass.email.value == ""){
    alert( "请输入Email" );
	document.frmgetpass.email.focus();
	return false;
  }
}
//-->
</script>
<br />
<form name="frmgetpass" id="frmgetpass" action="getpass.php?do=submit" method="post" onsubmit="return frmgetpass_validate();">
<table width="80%" class="grid" cellspacing="1" align="center">
  <caption>忘记密码？</caption>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">说明：</td>
    <td class="tdr" width="75%">提交以下信息并后，请查看您的邮箱，根据提示的链接返回本站重新设定密码。</td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl">用户名：</td>
    <td class="tdr"><input type="text" class="text" name="uname" id="uname" size="25" maxlength="30" value="" /></td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl">Email：</td>
	<td class="tdr"><input type="text" class="text" name="email" id="email" size="25" maxlength="60" value="" /></td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl">&nbsp;</td>
	<td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="提 交" /><input type="hidden" name="action" id="action" value="sendpass" /></td>
  </tr>
</table>
</form>
<br /><br /><br /><br />';
?>