<?php
echo '
<ul class="ultab">
<li><a href="'.jieqi_geturl('users','users','useredit','0').'"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'useredit.php'){
echo ' class="selected"';
}
echo '>�޸�����</a></li>
<li><a href="'.jieqi_geturl('users','users','setavatar','0').'"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'setavatar.php'){
echo ' class="selected"';
}
echo '>����ͷ��</a></li>
<li><a href="'.jieqi_geturl('users','users','passedit','0').'"';
if(basename($this->_tpl_vars['jieqi_thisfile']) == 'passedit.php'){
echo ' class="selected"';
}
echo '>�޸�����</a></li>
</ul>';
?>