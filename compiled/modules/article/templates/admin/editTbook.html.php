<?php
echo '<!--burn ��� 2016-12-27-->
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/edittbook.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>WAP��ѡ--��ѡ����</caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                ����
            </td>

            <td class="tdr">
                <input type="text" class="text" name="sort" value="'.$this->_tpl_vars['tbook']['sort'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                ���⣺
            </td>

            <td class="tdr">
                <input type="text" class="text" name="title"  value="'.$this->_tpl_vars['tbook']['title'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                �������ݣ�
            </td>

            <td class="tdr">
                <textarea class="textarea" name="desc" id="desc" rows="6" cols="60">'.$this->_tpl_vars['tbook']['desc'].'</textarea>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                bookID��
            </td>

            <td class="tdr">
                <input type="text" class="text" name="bookID" value="'.$this->_tpl_vars['tbook']['bookID'].'" />
                <span class="hottext">�������ID</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                �ϴ����棺
            </td>

            <td class="tdr">
                <input type="file" class="text" size="30" name="tbookCover" id="tbookCover"  accept="image/jpeg" />
                <span class="hottext">ͼƬ��ʽ��.jpg</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                ���棺
            </td>

            <td class="tdr">
                <img width="60%" src="'.$this->_tpl_vars['tbook']['cover'].'"  alt="'.$this->_tpl_vars['tbook']['title'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                ';
if($this->_tpl_vars['id'] != -1){
echo '
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="id"     value="'.$this->_tpl_vars['tbook']['id'].'" />
                <input type="hidden" name="cover"  value="'.$this->_tpl_vars['tbook']['cover'].'" />
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