<?php
echo '<script type="text/javascript">
function frmpersonedit_validate(){
  if(document.frmpersonedit.p_realname.value == ""){
    alert("��������ʵ����");
    document.frmpersonedit.p_realname.focus();
    return false;
  }
  if(document.frmpersonedit.p_telephone.value == "" && document.frmpersonedit.p_mobilephone.value == ""){
    alert("�绰/�ֻ� ������һ��");
    document.frmpersonedit.p_mobilephone.focus();
    return false;
  } 
  if(document.frmpersonedit.p_idcard.value == ""){
    alert("������֤������");
    document.frmpersonedit.p_idcard.focus();
    return false;
  }
  if(document.frmpersonedit.p_address.value == ""){
    alert("��������ϵ��ַ");
    document.frmpersonedit.p_address.focus();
    return false;
  }
}
</script>
<form name="frmpersonedit" id="frmpersonedit" action="'.$this->_tpl_vars['jieqi_url'].'/modules/article/admin/auxgzl.php?do=submit&id='.$this->_tpl_vars['uid'].'" method="post" onsubmit="return frmpersonedit_validate();" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>�༭����--'.$this->_tpl_vars['username'].'--ʵ����Ϣ</caption>
<tr valign="middle" align="left">
  <td class="tdl">��ʵ������</td>
  <td class="tdr"><input type="text" class="text" name="p_realname" id="p_realname" size="25" maxlength="100" value="'.$this->_tpl_vars['realname'].'" /> <span class="hot">����</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�绰��</td>
  <td class="tdr"><input type="text" class="text" name="p_telephone" id="p_telephone" size="25" maxlength="100" value="'.$this->_tpl_vars['telephone'].'" /> <span class="hot">�绰/�ֻ� ������һ��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֻ���</td>
  <td class="tdr"><input type="text" class="text" name="p_mobilephone" id="p_mobilephone" size="25" maxlength="100" value="'.$this->_tpl_vars['mobilephone'].'" /> <span class="hot">�绰/�ֻ� ������һ��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">֤�����ͣ�</td>
  <td class="tdr">
  <input type="radio" class="radio" name="p_idcardtype" id="p_idcardtype" value="1"';
if($this->_tpl_vars['idcardtype'] == '' || $this->_tpl_vars['idcardtype'] == '1'){
echo ' checked="checked"';
}
echo '  />���֤
  <input type="radio" class="radio" name="p_idcardtype" id="p_idcardtype" value="2"';
if($this->_tpl_vars['idcardtype'] == '2'){
echo ' checked="checked"';
}
echo ' />����
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">֤�����룺</td>
  <td class="tdr"><input type="text" class="text" name="p_idcard" id="p_idcard" size="25" maxlength="100" value="'.$this->_tpl_vars['idcard'].'" /> <span class="hot">����</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">��ϵ��ַ��</td>
  <td class="tdr"><input type="text" class="text" name="p_address" id="p_address"size="50" maxlength="250" value="'.$this->_tpl_vars['address'].'" /> <span class="hot">����</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ʱࣺ</td>
  <td class="tdr"><input type="text" class="text" name="p_zipcode" id="p_zipcode" size="25" maxlength="100" value="'.$this->_tpl_vars['zipcode'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�տ����У�</td>
  <td class="tdr">
  <input type="text" class="text" name="p_banktype" id="p_banktype" size="25" maxlength="100" value="'.$this->_tpl_vars['banktype'].'" /> <span class="hot">��д ��������/֧����/�ʾֻ��</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�������ڵأ�</td>
  <td class="tdr"><input type="text" class="text" name="p_bankname" id="p_bankname"  size="25" maxlength="100" value="'.$this->_tpl_vars['bankname'].'" /> <span class="hot">��д�����е� ʡ/��/��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">���ţ�</td>
  <td class="tdr"><input type="text" class="text" name="p_bankcard" id="p_bankcard"  size="25" maxlength="100" value="'.$this->_tpl_vars['bankcard'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֿ���������</td>
  <td class="tdr"><input type="text" class="text" name="p_bankuser" id="p_bankuser" size="25" maxlength="100" value="'.$this->_tpl_vars['bankuser'].'" /></td>
</tr>

<tr valign="middle" align="left">
  <td class="tdl">&nbsp;
  <input type="hidden" name="action" id="action" value="newauthor" />
  </td>
  <td class="tdl">&nbsp;
    <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['uid'].'" />
  </td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="�� ��" /></td>
</tr>
</table>
</form>';
?>