<?php
echo '<!--burn ��� 2016-12-19-->
<form action="'.$this->_tpl_vars['jieqi_url'].'/admin/editArticleChannel.php?do=submit" method="post">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>С˵Ƶ������</caption>
        ';
if($this->_tpl_vars['id'] != 0){
echo '
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                Ƶ��ID��
            </td>

            <td class="tdr">'.$this->_tpl_vars['id'].'</td>
        </tr>
        ';
}
echo '

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                Ƶ�����ƣ�
            </td>

            <td class="tdr">
                <input type="text" class="text" name="channel" size="25" maxlength="20" value="'.$this->_tpl_vars['channel'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                ';
if($this->_tpl_vars['id'] != 0){
echo '
                <input type="hidden" name="action"  value="edit" />
                <input type="hidden" name="id"  value="'.$this->_tpl_vars['id'].'" />
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