<?php
echo '<br />
<div class="tc">
<form name="frmdblogin" method="post" action="'.$this->_tpl_vars['url_dblogin'].'">
<table class="grid" width="500" align="center">
   <caption>数据库账号验证</caption>
   <tr>
     <td align="right">说明：</td>
	 <td>数据库管理相关功能需要验证本站的数据库用户名和密码！</td>
   </tr>
   <tr>
     <td align="right">数据库用户名：</td>
	 <td><input type="text" class="text" size="20" maxlength="50" style="width:120px" name="dbuser"></td>
   </tr>
   <tr>
     <td align="right">数据库密码：</td>
	 <td><input type="password" class="text" size="20" maxlength="50" style="width:120px" name="dbpass"></td>
   </tr>
   ';
if($this->_tpl_vars['show_checkcode'] == 1){
echo '
   <tr>
     <td align="right">验证码：</td>
     <td><input type="text" class="text" size="8" maxlength="8" name="checkcode">&nbsp;<img src="'.$this->_tpl_vars['url_checkcode'].'" style="cursor:pointer;" onclick="this.src=\''.$this->_tpl_vars['url_checkcode'].'?rand=\'+Math.random();"></td>
   </tr>
   ';
}
echo '
   <tr>
     <td>&nbsp;<input type="hidden" name="action" value="login"></td>
	 <td><input type="submit" class="button" value="&nbsp;提&nbsp;交&nbsp;" name="submit"></td>
   </tr>
  </table>
</form>
</div>
<br /><br />';
?>