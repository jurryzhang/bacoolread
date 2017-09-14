<?php
echo '
<div class="c_title">作品待审章节</div>
<hr />
<div class="c_head">作品名称：<a href="'.jieqi_geturl('article','article',$this->_tpl_vars['draftvals']['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['draftvals']['articlename'].'</a> | 章节名称：'.$this->_tpl_vars['draftvals']['chaptername'].' | 类型：';
if($this->_tpl_vars['draftvals']['isvip'] == 1){
echo '电子书';
}else{
echo '公众小说';
}
echo ' | 作者：<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['draftvals']['posterid']).'" target="_blank">'.$this->_tpl_vars['draftvals']['poster'].'</a> | 发表时间：'.date('Y-m-d H:i:s',$this->_tpl_vars['draftvals']['postdate']).'</div>
<hr />
<div class="c_content">'.$this->_tpl_vars['draftvals']['chaptercontent'].'</div>
<hr />

';
?>