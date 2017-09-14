<?php
echo '<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="25" valign="middle"><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/index.php">ÂÛÌ³Ê×Ò³</a> &gt; <a href="'.jieqi_geturl('forum','topiclist','1',$this->_tpl_vars['forumid']).'">'.$this->_tpl_vars['forumname'].'</a>';
if($this->_tpl_vars['topicid'] > 0){
echo ' &gt; <a href="'.jieqi_geturl('forum','showtopic',$this->_tpl_vars['topicid'],'1','1').'">'.$this->_tpl_vars['topictitle'].'</a>';
}
echo '</td>
    </tr>
    <tr>
        <td align="center">'.$this->_tpl_vars['postform'].'</td>
    </tr>
</table>
';
?>