<?php
echo '<!--burn ��� 2016-12-19-->
<form action="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editSearchKeyWord.php" method="post">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>APP��̨--���Ѵ�����</caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                bookID��
            </td>

            <td class="tdr">
                <input type="text" class="text" name="bookID"  value="'.$this->_tpl_vars['hotSearchWord']['bookID'].'" />
                </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                С˵���ƣ�
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
                <input type="submit" class="button" name="submit"  id="submit" value="�����޸�" />
                ';
}else{
echo '
                <input type="hidden" name="action" id="action" value="add" />
            </td>

            <td class="tdr">
                <input type="submit" class="button" name="submit"  id="submit" value="�� ��" />
                ';
}
echo '

            </td>
        </tr>
    </table>
</form>';
?>