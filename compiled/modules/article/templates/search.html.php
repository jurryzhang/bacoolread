<?php
echo '<br /><br />
<form name="articlesearch" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/search.php">
 <table class="grid" width="250" align="center">
   <caption>С˵����</caption>
    <tr align="center">
      <td><table width="100%" class="hide" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="37%" align="right" valign="middle">��������</td>
          <td width="63%">
		  <select name="searchtype" id="searchtype" class="select">
		  <option value="all" selected="selected">�ۺ�</option>
		  <option value="articlename">С˵����</option>
		  <option value="author">С˵����</option>
		  <option value="keywords">�ؼ���</option>
		  </select>
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle">�ؼ��֣�</td>
          <td><input name="searchkey" type="text" class="text" id="searchkey" size="10" maxlength="50"></td>
        </tr>
        <tr>
		  <td><input type="hidden" name="action" value="search"></td>
          <td><input type="submit" class="button" value="&nbsp;��&nbsp;&nbsp;��&nbsp;" name="submit"></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
<br /><br />';
?>