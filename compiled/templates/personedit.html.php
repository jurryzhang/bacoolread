<?php
echo '
<script type="text/javascript">
function frmpersonedit_validate(){
  if(document.frmpersonedit.p_realname.value == ""){
    alert("请输入真实姓名");
    document.frmpersonedit.p_realname.focus();
    return false;
  }
  if(document.frmpersonedit.p_telephone.value == "" && document.frmpersonedit.p_mobilephone.value == ""){
    alert("电话/手机 至少填一项");
    document.frmpersonedit.p_mobilephone.focus();
    return false;
  } 
  if(document.frmpersonedit.p_idcard.value == ""){
    alert("请输入证件号码");
    document.frmpersonedit.p_idcard.focus();
    return false;
  }
  if(document.frmpersonedit.p_address.value == ""){
    alert("请输入联系地址");
    document.frmpersonedit.p_address.focus();
    return false;
  }
}
</script>
<form name="frmpersonedit" id="frmpersonedit" action="'.$this->_tpl_vars['jieqi_url'].'/personedit.php?do=submit" method="post" onsubmit="return frmpersonedit_validate();" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>编辑作者实名信息</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">说明：</td>
  <td class="tdr"><span class="hot">请填写真实信息，否则申请作者可能无法收到签约协议。</span></td>
</tr>
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
  <td class="tdr"><input type="text" class="text" name="p_telephone" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['telephone'].'" /> <span class="hot">电话/手机/QQ 至少填一项</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">手机：</td>
  <td class="tdr"><input type="text" class="text" name="p_mobilephone" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['mobilephone'].'" /> <span class="hot">电话/手机/QQ 至少填一项</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">QQ：</td>
  <td class="tdr"><input type="text" class="text" name="p_qq" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['qq'].'" /> <span class="hot">电话/手机/QQ 至少填一项</span></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">证件类型：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="p_idcardtype" value="身份证"';
if($this->_tpl_vars['personsvars']['idcardtype'] == '' || $this->_tpl_vars['personsvars']['idcardtype'] == '身份证'){
echo ' checked="checked"';
}
echo '  />身份证
  <input type="radio" class="radio" name="p_idcardtype" value="护照"';
if($this->_tpl_vars['personsvars']['idcardtype'] == '护照'){
echo ' checked="checked"';
}
echo ' />护照
  </td>
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
  <td class="tdr"><input type="text" class="text" name="p_divided" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['divided'].'" readonly />%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">此项只能由管理员修改，请与管理员洽谈结算分成</font></td>
</tr>
<!--<tr valign="middle" align="left">
  <td class="tdl"><a name="student"></a>参赛说明：</td>
  <td class="tdr">
  <span class="hot">如果您参加了征文比赛，并且是学生，请务必填写以下内容</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">所属学校：</td>
  <td class="tdr"><input type="text" class="text" name="p_addvars[school]" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['addvars']['school'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">学生证号码：</td>
  <td class="tdr"><input type="text" class="text" name="p_addvars[studentid]" size="25" maxlength="100" value="'.$this->_tpl_vars['personsvars']['addvars']['studentid'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">学生证图片：</td>
  <td class="tdr"><input type="file" class="text" size="30" name="studentcard" /> <span class="hot">请使用jpg格式图片，大小不超过2M</span></td>
</tr>-->
<tr valign="middle" align="left">
  <td class="tdl">&nbsp;
  <input type="hidden" name="action" id="action" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'
  </td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="保 存" /></td>
</tr>
</table>
</form>';
?>