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
<form name="personmanage" id="personmanage" action="'.$this->_tpl_vars['jieqi_url'].'/admin/personmanage.php?do=submit" method="post" onsubmit="return jieqiFormValidate_usermanage();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>��ϵ��Ϣ</caption>
';
if($this->_tpl_vars['personsvars']['realname'] == ''){
echo '
<tr valign="middle" align="left">
  <td class="tdl"><font color ="red">��ʾ��</font></td>
  <td class="tdr"><font color ="red">���û�δ��д��ϵ��Ϣ�����Ǳ�վ���ߣ���Ҫվ�ڷ��������Ѳ��䣡</font></td>
</tr>
';
}else{
echo '
<tr valign="middle" align="left">
  <td class="tdl">��ʵ������</td>
  <td class="tdr"><input type="text" class="text" name="p_realname" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['realname'].'" /> <span class="hot">����</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�Ա�</td>
  <td class="tdr">
  <input type="radio" class="radio" name="p_gender" value="��"';
if($this->_tpl_vars['personsvars']['gender'] == '' || $this->_tpl_vars['personsvars']['gender'] == '��'){
echo ' checked="checked"';
}
echo '  />��
  <input type="radio" class="radio" name="p_gender" value="Ů"';
if($this->_tpl_vars['personsvars']['gender'] == 'Ů'){
echo ' checked="checked"';
}
echo ' />Ů
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�绰��</td>
  <td class="tdr"><input type="text" class="text" name="p_telephone" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['telephone'].'" /> <span class="hot">�绰/�ֻ� ������һ��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֻ���</td>
  <td class="tdr"><input type="text" class="text" name="p_mobilephone" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['mobilephone'].'" /> <span class="hot">�绰/�ֻ� ������һ��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">֤�����ͣ�</td>
  <td class="tdr">
  <input type="text" class="text" name="p_idcardtype" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['idcardtype'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">֤�����룺</td>
  <td class="tdr"><input type="text" class="text" name="p_idcard" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['idcard'].'" /> <span class="hot">����</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">��ϵ��ַ��</td>
  <td class="tdr"><input type="text" class="text" name="p_address" size="50" maxlength="250" value="'.$this->_tpl_vars['personsvars']['address'].'" /> <span class="hot">����</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ʱࣺ</td>
  <td class="tdr"><input type="text" class="text" name="p_zipcode" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['zipcode'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�տ����У�</td>
  <td class="tdr">
  <input type="text" class="text" name="p_banktype" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['banktype'].'" /> <span class="hot">��д ��������/֧����/�ʾֻ��</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�������ڵأ�</td>
  <td class="tdr"><input type="text" class="text" name="p_bankname" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['bankname'].'" /> <span class="hot">��д�����е� ʡ/��/��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">���ţ�</td>
  <td class="tdr"><input type="text" class="text" name="p_bankcard" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['bankcard'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֿ���������</td>
  <td class="tdr"><input type="text" class="text" name="p_bankuser" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['bankuser'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">������Ϣ��</td>
  <td class="tdr">
  <textarea class="textarea" name="p_mynote" rows="5" cols="50">'.$this->_tpl_vars['personsvars']['mynote'].'</textarea>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">���ֳɱ�����</td>
  <td class="tdr"><input type="text" class="text" name="p_divided" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['divided'].'" />% <span class="hot">����Ϊ����Ա����</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�Ƿ��������ϣ�</td>
  <td class="tdr"><input type="radio" class="radio" name="denyedit" value="0" ';
if($this->_tpl_vars['personsvars']['denyedit'] == '0'){
echo 'checked="checked" ';
}
echo '/>��
<input type="radio" class="radio" name="denyedit" value="1" ';
if($this->_tpl_vars['personsvars']['denyedit'] == '1'){
echo 'checked="checked" ';
}
echo '/>��&nbsp;&nbsp;&nbsp;&nbsp;<span class="hot"></span>
</td>
</tr>
';
}
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['uid'].'" /></td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="�����޸�" />&nbsp;&nbsp;<input type="button" class="button" name="submit"  id="submit" value="����" onclick="javascript:history.back();" /></td>
</tr>
</table>
</form>';
?>