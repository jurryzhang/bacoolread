<?php
echo '<!--burn 添加 2016-12-19-->
<form action="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editSearchKeyWord.php" method="post">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>APP后台--热搜词设置</caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                bookID：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="bookID"  value="'.$this->_tpl_vars['hotSearchWord']['bookID'].'" />
                </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                小说名称：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="bookName"  value="'.$this->_tpl_vars['hotSearchWord']['bookName'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                ';
if($this->_tpl_vars['id'] != -1){
echo '
                <input type="hidden" name="action"  value="edit" />
                <input type="hidden" name="id"  value="'.$this->_tpl_vars['hotSearchWord']['id'].'" />
            </td>

            <td class="tdr">
                <input type="submit" class="button" name="submit"  id="submit" value="保存修改" />
                ';
}else{
echo '
                <input type="hidden" name="action" id="action" value="add" />
            </td>

            <td class="tdr">
                <input type="submit" class="button" name="submit"  id="submit" value="增 加" />
                ';
}
echo '

            </td>
        </tr>
    </table>
</form>';
?>