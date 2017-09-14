<?php
echo '

<table width="100%" class="grid" cellspacing="1" align="center">
<caption>查看作者实名信息</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">说明：</td>
  <td class="tdr"><span class="hot">以下是您的真实联系方式，用于网站管理员跟您联系及收入结算，不会对外公开！</span>
  ';
if($this->_tpl_vars['personsvars']['denyedit'] != 0){
echo '<br /><span class="hot">您的信息已被锁定，禁止修改！如果确实需要修改，请联系管理员处理。</span>';
}
echo '
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">真实姓名：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['realname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">性别：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['gender'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">电话：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['telephone'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">手机：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['mobilephone'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">QQ：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['qq'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">证件类型：</td>
  <td class="tdr">';
if($this->_tpl_vars['personsvars']['idcardtype'] == ''){
echo '身份证';
}else{
echo $this->_tpl_vars['personsvars']['idcardtype'];
}
echo '</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">证件号码：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['idcard'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">联系地址：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['address'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">邮编：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['zipcode'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">收款银行：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['banktype'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">银行所在地：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['bankname'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">卡号：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['bankcard'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">持卡人姓名：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['bankuser'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">补充信息：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['mynote'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">稿酬分成比例：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['divided'].'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">此项只能由管理员修改，请与管理员洽谈结算分成</font></td>
</tr>
<!--<tr valign="middle" align="left">
  <td class="tdl">所属学校：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['addvars']['school'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">学生证号码：</td>
  <td class="tdr">'.$this->_tpl_vars['personsvars']['addvars']['studentid'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">学生证图片：</td>
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
echo '<a class="btnlink" href="'.$this->_tpl_vars['jieqi_url'].'/personedit.php">点击修改联系方式</a>';
}else{
echo '<span class="hot">您的信息已被锁定，禁止修改！如果确实需要修改，请联系管理员处理。</span>';
}
echo '
  ';
if($this->_tpl_vars['jieqi_group'] == 3 && $this->_tpl_vars['jieqi_modules']['article']['publish'] > 0){
echo '&nbsp;&nbsp;<a class="btnlink" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/applywriter.php">申请成为作者</a>';
}
echo '
  </td>
</tr>
</table>';
?>