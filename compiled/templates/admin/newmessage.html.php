<?php
echo '<script type="text/javascript">
<!--
function frmnewmessage_validate(){
  if(typeof(document.frmnewmessage.receiver) != "undefined"){
    if(document.frmnewmessage.receiver.value == "" ){
      alert("�������ռ���");
	  document.frmnewmessage.receiver.focus();
	  return false;
    }
  }
  if(document.frmnewmessage.title.value == ""){
    alert("���������");
	window.document.frmnewmessage.title.focus();
	return false;
  }
}
//-->
</script>
<form name="frmnewmessage" id="frmnewmessage" action="newmessage.php?do=submit" method="post" onsubmit="return frmnewmessage_validate();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>д����Ϣ</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�ռ��ˣ�</td>
  <td class="tdr"><input type="text" class="text" name="receiver" id="receiver" size="30" maxlength="30" value="'.$this->_tpl_vars['receiver'].'" /></td>
</tr>
  <tr valign="middle" align="left"><td class="tdl" width="25%">���⣺</td>
  <td class="tdr"><input type="text" class="text" name="title" id="title" size="30" maxlength="100" value="'.$this->_tpl_vars['title'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">���ݣ�</td>
  <td class="tdr"><textarea class="textarea" name="content" id="content" rows="12" cols="60">'.$this->_tpl_vars['content'].'</textarea></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;</td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="�� ��" /><input type="hidden" name="action" id="action" value="newmessage" /></td>
</tr>
</table>
</form>';
?>