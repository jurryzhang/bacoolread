<?php
echo '<table width="100%" class="grid" cellspacing="1" align="center">
<caption>����ʵ����Ϣ</caption>
<tr valign="middle" align="left">
  <td class="tdl">��ʵ������</td>
  <td class="tdr">'.$this->_tpl_vars['realname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�绰��</td>
  <td class="tdr">'.$this->_tpl_vars['telephone'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֻ���</td>
  <td class="tdr">'.$this->_tpl_vars['mobilephone'].'</td>
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
  <td class="tdr">'.$this->_tpl_vars['idcard'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">��ϵ��ַ��</td>
  <td class="tdr">'.$this->_tpl_vars['address'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ʱࣺ</td>
  <td class="tdr">'.$this->_tpl_vars['zipcode'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�տ����У�</td>
  <td class="tdr">
  '.$this->_tpl_vars['banktype'].'
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�������ڵأ�</td>
  <td class="tdr">'.$this->_tpl_vars['bankname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">���ţ�</td>
  <td class="tdr">'.$this->_tpl_vars['bankcard'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֿ���������</td>
  <td class="tdr">'.$this->_tpl_vars['bankuser'].'</td>
</tr>
</table>';
?>