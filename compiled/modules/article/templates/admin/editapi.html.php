<?php
echo '<!--burn ��� 2016-12-27-->
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/editapi.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>WAP��ѡ--��ѡ����</caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                ��������
            </td>

            <td class="tdr">
                <input type="text" class="text" name="partner" value="'.$this->_tpl_vars['api']['partner'].'" />
            </td>
        </tr>

        

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                bookIDs��
            </td>

            <td class="tdr">
                <textarea  height="500px" class="textarea" name="bookIDs" id="bookIDs" rows="5" cols="50">'.$this->_tpl_vars['api']['bookIDs'].'</textarea>
				<span class="hottext">��Ȩ�鼮��ID</span>
            </td>
        </tr>
		
		<tr valign="middle" align="left">
            <td class="tdl" width="25%">
                �������ӣ�
            </td>

            <td class="tdr">
                <input type="text" class="text" name="url" size="50" value="'.$this->_tpl_vars['api']['url'].'" />
            </td>
        </tr>

        

        

        

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                ';
if($this->_tpl_vars['id'] != -1){
echo '
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="id"     value="'.$this->_tpl_vars['api']['id'].'" />
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