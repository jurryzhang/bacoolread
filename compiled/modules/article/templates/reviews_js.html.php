<?php
if($this->_tpl_vars['ajax_request'] > 0){
echo $this->_tpl_vars['c'].'("'.$this->_tpl_vars['logs'].'   \\r\\n   <input type=\\"hidden\\" name=\\"loadreview_has_next_page\\"   value=\\"'.$this->_tpl_vars['pages'].'\\" \\/>");
';
}else{
echo $this->_tpl_vars['logs'].' 
<input type="hidden" name="loadreview_has_next_page"   value="'.$this->_tpl_vars['pages'].' " />

';
}

?>