<?php
echo '<!--burn 添加 2016-12-27-->
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editTopic.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>APP后台--专题设置</caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                专题ID：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="topicID" value="'.$this->_tpl_vars['topic']['topicID'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                名称：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="title"  value="'.$this->_tpl_vars['topic']['title'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                专题介绍：
            </td>

            <td class="tdr">
                <textarea class="textarea" name="summary" id="summary" rows="6" cols="60">'.$this->_tpl_vars['topic']['summary'].'</textarea>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                bookID：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="booksID" value="'.$this->_tpl_vars['topic']['booksID'].'" />
                <span class="hottext">多本书用"|"隔开</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                上传封面：
            </td>

            <td class="tdr">
                <input type="file" class="text" size="30" name="topicCover" id="topicCover"  accept="image/jpeg" />
                <span class="hottext">图片格式：.jpg</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                封面：
            </td>

            <td class="tdr">
                <img width="60%" src="'.$this->_tpl_vars['topic']['cover'].'"  alt="'.$this->_tpl_vars['topicList'][$this->_tpl_vars['i']['key']]['title'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                ';
if($this->_tpl_vars['id'] != -1){
echo '
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="id"     value="'.$this->_tpl_vars['topic']['id'].'" />
                <input type="hidden" name="cover"  value="'.$this->_tpl_vars['topic']['cover'].'" />
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