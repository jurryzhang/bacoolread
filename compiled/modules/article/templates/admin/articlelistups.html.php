<?php
echo '<form name="vipmanage" id="vipmanage" action="'.$this->_tpl_vars['jieqi_url'].'/modules/article/admin/articleups.php?do=submit" method="post" onsubmit="return jieqiFormValidate_usermanage();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>���봦��</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�����ǳƣ�</td>
  <td class="tdr">'.$this->_tpl_vars['username'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">��ϵ��ʽ���ֻ�����</td>
  <td class="tdr">'.$this->_tpl_vars['pc'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">����������</td>
  <td class="tdr">'.$this->_tpl_vars['bookname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�������ͣ�</td>
  <td class="tdr">'.$this->_tpl_vars['types'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�������ɣ�</td>
  <td class="tdr">'.$this->_tpl_vars['text'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�Ƿ�ͨ����ˣ�</td>
  <td class="tdr">  
  <input type="radio" class="radio" name="type" value="1" checked="checked" />��ͨ��
  <input type="radio" class="radio" name="type" value="2" />ͨ��
</td>
</tr>

<tr valign="middle" align="left">
  <td class="tdl" width="25%">���ɣ�</td>
  <td class="tdr"><textarea class="textarea" name="texts" id="texts" rows="6" cols="60"></textarea></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['id'].'" /></td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="ȷ��" /></td>
</tr>
</table>
</form>';
?>