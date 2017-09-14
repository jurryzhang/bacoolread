<?php
echo '<table width="100%" class="grid" cellspacing="1" align="center">
<caption>作者实名信息</caption>
<tr valign="middle" align="left">
  <td class="tdl">真实姓名：</td>
  <td class="tdr">'.$this->_tpl_vars['realname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">电话：</td>
  <td class="tdr">'.$this->_tpl_vars['telephone'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">手机：</td>
  <td class="tdr">'.$this->_tpl_vars['mobilephone'].'</td>
</tr>

<tr valign="middle" align="left">
  <td class="tdl">证件类型：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="p_idcardtype" id="p_idcardtype" value="1"';
if($this->_tpl_vars['idcardtype'] == '' || $this->_tpl_vars['idcardtype'] == '1'){
echo ' checked="checked"';
}
echo '  />身份证
  <input type="radio" class="radio" name="p_idcardtype" id="p_idcardtype" value="2"';
if($this->_tpl_vars['idcardtype'] == '2'){
echo ' checked="checked"';
}
echo ' />护照
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">证件号码：</td>
  <td class="tdr">'.$this->_tpl_vars['idcard'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">联系地址：</td>
  <td class="tdr">'.$this->_tpl_vars['address'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">邮编：</td>
  <td class="tdr">'.$this->_tpl_vars['zipcode'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">收款银行：</td>
  <td class="tdr">
  '.$this->_tpl_vars['banktype'].'
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">银行所在地：</td>
  <td class="tdr">'.$this->_tpl_vars['bankname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">卡号：</td>
  <td class="tdr">'.$this->_tpl_vars['bankcard'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">持卡人姓名：</td>
  <td class="tdr">'.$this->_tpl_vars['bankuser'].'</td>
</tr>
</table>';
?>