<?php
echo '

<table width="100%" class="grid" cellspacing="1" align="center">
<caption>�鿴����ʵ����Ϣ</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">˵����</td>
  <td class="tdr"><span class="hot">������������ʵ��ϵ��ʽ��������վ����Ա������ϵ��������㣬������⹫����</span>
  ';
if($this->_tpl_vars['personsvars']['denyedit'] != 0){
echo '<br /><span class="hot">������Ϣ�ѱ���������ֹ�޸ģ����ȷʵ��Ҫ�޸ģ�����ϵ����Ա����</span>';
}
echo '
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">��ʵ������</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['realname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�Ա�</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['gender'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�绰��</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['telephone'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֻ���</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['mobilephone'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">QQ��</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['qq'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">֤�����ͣ�</td>
  <td class="tdr">';
if($this->_tpl_vars['personsvars']['idcardtype'] == ''){
echo '���֤';
}else{
echo $this->_tpl_vars['personsvars']['idcardtype'];
}
echo '</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">֤�����룺</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['idcard'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">��ϵ��ַ��</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['address'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ʱࣺ</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['zipcode'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�տ����У�</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['banktype'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�������ڵأ�</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['bankname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">���ţ�</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['bankcard'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">�ֿ���������</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['bankuser'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">������Ϣ��</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['mynote'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">���ֳɱ�����</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['divided'].'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">����ֻ���ɹ���Ա�޸ģ��������ԱǢ̸����ֳ�</font></td>
</tr>
<!--<tr valign="middle" align="left">
  <td class="tdl">����ѧУ��</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['addvars']['school'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">ѧ��֤���룺</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['addvars']['studentid'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">ѧ��֤ͼƬ��</td>
  <td class="tdr">';
if($this->_tpl_vars['personsvars']['addvars']['studentcard'] != ''){
echo '<img src="'.$this->_tpl_vars['jieqi_url'].'/files/system/person'.subdirectory($this->_tpl_vars['personsvars']['uid']).'/'.$this->_tpl_vars['personsvars']['uid'].'/'.$this->_tpl_vars['personsvars']['addvars']['studentcard'].'" border="0" onload="imgResize(this);" onmouseover="imgMenu(this);" onclick="imgDialog(\''.$this->_tpl_vars['jieqi_url'].'/files/system/person'.subdirectory($this->_tpl_vars['personsvars']['uid']).'/'.$this->_tpl_vars['personsvars']['uid'].'/'.$this->_tpl_vars['personsvars']['addvars']['studentcard'].'\', this);" />';
}
echo '</td>
</tr>-->
<tr valign="middle" align="left">
  <td class="foot" colspan="2">
  ';
if($this->_tpl_vars['personsvars']['denyedit'] == 0){
echo '<a class="btnlink" href="'.$this->_tpl_vars['jieqi_url'].'/personedit.php">����޸���ϵ��ʽ</a>';
}else{
echo '<span class="hot">������Ϣ�ѱ���������ֹ�޸ģ����ȷʵ��Ҫ�޸ģ�����ϵ����Ա����</span>';
}
echo '
  ';
if($this->_tpl_vars['jieqi_group'] == 3 && $this->_tpl_vars['jieqi_modules']['article']['publish'] > 0){
echo '&nbsp;&nbsp;<a class="btnlink" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/applywriter.php">�����Ϊ����</a>';
}
echo '
  </td>
</tr>
</table>';
?>