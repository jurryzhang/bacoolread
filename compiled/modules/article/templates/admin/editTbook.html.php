<?php
echo '<!--burn 添加 2016-12-27-->
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/edittbook.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>WAP精选--精选设置</caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                排序：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="sort" value="'.$this->_tpl_vars['tbook']['sort'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                标题：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="title"  value="'.$this->_tpl_vars['tbook']['title'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                描述内容：
            </td>

            <td class="tdr">
                <textarea class="textarea" name="desc" id="desc" rows="6" cols="60">'.$this->_tpl_vars['tbook']['desc'].'</textarea>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                bookID：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="bookID" value="'.$this->_tpl_vars['tbook']['bookID'].'" />
                <span class="hottext">单本书的ID</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                上传封面：
            </td>

            <td class="tdr">
                <input type="file" class="text" size="30" name="tbookCover" id="tbookCover"  accept="image/jpeg" />
                <span class="hottext">图片格式：.jpg</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                封面：
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