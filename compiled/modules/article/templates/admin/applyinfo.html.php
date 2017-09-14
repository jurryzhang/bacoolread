<?php
echo '<div class="c_title">作家申请信息</div>
<hr />
<div class="c_head">申请时间：'.$this->_tpl_vars['applytime'].' | 申请人：<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['applyuid']).'" target="_blank">'.$this->_tpl_vars['applyname'].'</a> | 申请内容字数：'.$this->_tpl_vars['applysize'].'</div>
<hr />
<div class="c_content">'.$this->_tpl_vars['applytext'].'</div>
<hr />
<div class="tr"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=confirm&id='.$this->_tpl_vars['applyid'].'">审核</a> <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=refuse&id='.$this->_tpl_vars['applyid'].'">拒绝</a> <a href="javascript:if(confirm(\'确实要删除该申请记录么？\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=delete&id='.$this->_tpl_vars['applyid'].'\'">删除</a><br /><br /></div>
';
?>