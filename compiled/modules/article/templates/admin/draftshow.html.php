<?php
echo '
<div class="c_title">��Ʒ�����½�</div>
<hr />
<div class="c_head">��Ʒ���ƣ�<a href="'.jieqi_geturl('article','article',$this->_tpl_vars['draftvals']['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['draftvals']['articlename'].'</a> | �½����ƣ�'.$this->_tpl_vars['draftvals']['chaptername'].' | ���ͣ�';
if($this->_tpl_vars['draftvals']['isvip'] == 1){
echo '������';
}else{
echo '����С˵';
}
echo ' | ���ߣ�<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['draftvals']['posterid']).'" target="_blank">'.$this->_tpl_vars['draftvals']['poster'].'</a> | ����ʱ�䣺'.date('Y-m-d H:i:s',$this->_tpl_vars['draftvals']['postdate']).'</div>
<hr />
<div class="c_content">'.$this->_tpl_vars['draftvals']['chaptercontent'].'</div>
<hr />

';
?>