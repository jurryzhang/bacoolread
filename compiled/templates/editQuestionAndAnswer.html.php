<?php
echo '<!--burn ��� 2016-12-27-->
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editQuestionAndAnswer.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>APP��̨--������������</caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                id��
            </td>

            <td class="tdr">
                <input type="text" name="showid" value="'.$this->_tpl_vars['questionAndAnswer']['showid'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                ���⣺
            </td>

            <td class="tdr">
                <textarea class="textarea" name="question" rows="6" cols="60">'.$this->_tpl_vars['questionAndAnswer']['question'].'</textarea>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                �𰸣�
            </td>

            <td class="tdr">
                <textarea class="textarea" name="answer" rows="6" cols="60">'.$this->_tpl_vars['questionAndAnswer']['answer'].'</textarea>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                ';
if($this->_tpl_vars['id'] != -1){
echo '
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="id"     value="'.$this->_tpl_vars['questionAndAnswer']['id'].'" />
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