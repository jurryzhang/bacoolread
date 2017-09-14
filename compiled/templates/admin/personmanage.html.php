<?php
echo '<script type="text/javascript">
<!--
function jieqiFormValidate_usermanage(){
  if(document.usermanage.groupid.value == ""){
    alert("请输入等级");
    document.usermanage.groupid.focus();
    return false;
  }
}
//-->
</script>
<form name="personmanage" id="personmanage" action="'.$this->_tpl_vars['jieqi_url'].'/admin/personmanage.php?do=submit" method="post" onsubmit="return jieqiFormValidate_usermanage();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>联系信息</caption>
';
if($this->_tpl_vars['personsvars']['realname'] == ''){
echo '
<tr valign="middle" align="left">
  <td class="tdl"><font color ="red">提示：</font></td>
  <td class="tdr"><font color ="red">此用户未填写联系信息；如是本站作者，需要站内发邮箱提醒补充！</font></td>
</tr>
';
}else{
echo '
<tr valign="middle" align="left">
  <td class="tdl">真实姓名：</td>
  <td class="tdr"><input type="text" class="text" name="p_realname" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['realname'].'" /> <span class="hot">必填</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">性别：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="p_gender" value="男"';
if($this->_tpl_vars['personsvars']['gender'] == '' || $this->_tpl_vars['personsvars']['gender'] == '男'){
echo ' checked="checked"';
}
echo '  />男
  <input type="radio" class="radio" name="p_gender" value="女"';
if($this->_tpl_vars['personsvars']['gender'] == '女'){
echo ' checked="checked"';
}
echo ' />女
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">电话：</td>
  <td class="tdr"><input type="text" class="text" name="p_telephone" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['telephone'].'" /> <span class="hot">电话/手机 至少填一项</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">手机：</td>
  <td class="tdr"><input type="text" class="text" name="p_mobilephone" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['mobilephone'].'" /> <span class="hot">电话/手机 至少填一项</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">证件类型：</td>
  <td class="tdr">
  <input type="text" class="text" name="p_idcardtype" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['idcardtype'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">证件号码：</td>
  <td class="tdr"><input type="text" class="text" name="p_idcard" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['idcard'].'" /> <span class="hot">必填</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">联系地址：</td>
  <td class="tdr"><input type="text" class="text" name="p_address" size="50" maxlength="250" value="'.$this->_tpl_vars['personsvars']['address'].'" /> <span class="hot">必填</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">邮编：</td>
  <td class="tdr"><input type="text" class="text" name="p_zipcode" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['zipcode'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">收款银行：</td>
  <td class="tdr">
  <input type="text" class="text" name="p_banktype" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['banktype'].'" /> <span class="hot">填写 银行名称/支付宝/邮局汇款</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">银行所在地：</td>
  <td class="tdr"><input type="text" class="text" name="p_bankname" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['bankname'].'" /> <span class="hot">填写开户行的 省/市/区</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">卡号：</td>
  <td class="tdr"><input type="text" class="text" name="p_bankcard" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['bankcard'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">持卡人姓名：</td>
  <td class="tdr"><input type="text" class="text" name="p_bankuser" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['bankuser'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">补充信息：</td>
  <td class="tdr">
  <textarea class="textarea" name="p_mynote" rows="5" cols="50">'.$this->_tpl_vars['personsvars']['mynote'].'</textarea>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">稿酬分成比例：</td>
  <td class="tdr"><input type="text" class="text" name="p_divided" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['divided'].'" />% <span class="hot">此项为管理员设置</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">是否锁定资料：</td>
  <td class="tdr"><input type="radio" class="radio" name="denyedit" value="0" ';
if($this->_tpl_vars['personsvars']['denyedit'] == '0'){
echo 'checked="checked" ';
}
echo '/>否
<input type="radio" class="radio" name="denyedit" value="1" ';
if($this->_tpl_vars['personsvars']['denyedit'] == '1'){
echo 'checked="checked" ';
}
echo '/>是&nbsp;&nbsp;&nbsp;&nbsp;<span class="hot"></span>
</td>
</tr>
';
}
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="update" /><input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['uid'].'" /></td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="保存修改" />&nbsp;&nbsp;<input type="button" class="button" name="submit"  id="submit" value="返回" onclick="javascript:history.back();" /></td>
</tr>
</table>
</form>';
?>