<?php
echo '<br /><br />
<form name="articlesearch" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/search.php">
 <table class="grid" width="250" align="center">
   <caption>小说搜索</caption>
    <tr align="center">
      <td><table width="100%" class="hide" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="37%" align="right" valign="middle">条　件：</td>
          <td width="63%">
		  <select name="searchtype" id="searchtype" class="select">
		  <option value="all" selected="selected">综合</option>
		  <option value="articlename">小说名称</option>
		  <option value="author">小说作者</option>
		  <option value="keywords">关键字</option>
		  </select>
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle">关键字：</td>
          <td><input name="searchkey" type="text" class="text" id="searchkey" size="10" maxlength="50"></td>
        </tr>
        <tr>
		  <td><input type="hidden" name="action" value="search"></td>
          <td><input type="submit" class="button" value="&nbsp;搜&nbsp;&nbsp;索&nbsp;" name="submit"></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
<br /><br />';
?>