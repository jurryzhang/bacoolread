<?php
echo '
<script type="text/javascript">
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
<form name="frmpersonedit" id="frmpersonedit" action="'.$this->_tpl_vars['jieqi_url'].'/personedit.php?do=submit" method="post" onsubmit="return frmpersonedit_validate();" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>�༭����ʵ����Ϣ</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">˵����</td>
  <td class="tdr"><span class="hot">����д��ʵ��Ϣ�������������߿����޷��յ�ǩԼЭ�顣</span></td>
</tr>
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
  <td class="tdr"><input type="text" class="text" name="p_telephone" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['telephone'].'" /> <span class="hot">�绰/�ֻ�/QQ ������һ��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֻ���</td>
  <td class="tdr"><input type="text" class="text" name="p_mobilephone" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['mobilephone'].'" /> <span class="hot">�绰/�ֻ�/QQ ������һ��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">QQ��</td>
  <td class="tdr"><input type="text" class="text" name="p_qq" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['qq'].'" /> <span class="hot">�绰/�ֻ�/QQ ������һ��</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">֤�����ͣ�</td>
  <td class="tdr">
  <input type="radio" class="radio" name="p_idcardtype" value="���֤"';
if($this->_tpl_vars['personsvars']['idcardtype'] == '' || $this->_tpl_vars['personsvars']['idcardtype'] == '���֤'){
echo ' checked="checked"';
}
echo '  />���֤
  <input type="radio" class="radio" name="p_idcardtype" value="����"';
if($this->_tpl_vars['personsvars']['idcardtype'] == '����'){
echo ' checked="checked"';
}
echo ' />����
  </td>
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
  <td class="tdr"><input type="text" class="text" name="p_divided" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['divided'].'" readonly />%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">����ֻ���ɹ���Ա�޸ģ��������ԱǢ̸����ֳ�</font></td>
</tr>
<!--<tr valign="middle" align="left">
  <td class="tdl"><a name="student"></a>����˵����</td>
  <td class="tdr">
  <span class="hot">������μ������ı�����������ѧ�����������д��������</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">����ѧУ��</td>
  <td class="tdr"><input type="text" class="text" name="p_addvars[school]" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['addvars']['school'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">ѧ��֤���룺</td>
  <td class="tdr"><input type="text" class="text" name="p_addvars[studentid]" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['addvars']['studentid'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">ѧ��֤ͼƬ��</td>
  <td class="tdr"><input type="file" class="text" size="30" name="studentcard" /> <span class="hot">��ʹ��jpg��ʽͼƬ����С������2M</span></td>
</tr>-->
<tr valign="middle" align="left">
  <td class="tdl">&nbsp;
  <input type="hidden" name="action" id="action" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'
  </td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="�� ��" /></td>
</tr>
</table>
</form>';
?>