<?php
echo '<div class="c_title">����������Ϣ</div>
<hr />
<div class="c_head">����ʱ�䣺'.$this->_tpl_vars['applytime'].' | �����ˣ�<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['applyuid']).'" target="_blank">'.$this->_tpl_vars['applyname'].'</a> | ��������������'.$this->_tpl_vars['applysize'].'</div>
<hr />
<div class="c_content">'.$this->_tpl_vars['applytext'].'</div>
<hr />
<div class="tr"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=confirm&id='.$this->_tpl_vars['applyid'].'">���</a> <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=refuse&id='.$this->_tpl_vars['applyid'].'">�ܾ�</a> <a href="javascript:if(confirm(\'ȷʵҪɾ���������¼ô��\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=delete&id='.$this->_tpl_vars['applyid'].'\'">ɾ��</a><br /><br /></div>
';
?>