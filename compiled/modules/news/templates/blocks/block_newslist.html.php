<?php
if (empty($this->_tpl_vars['newsrows'])) $this->_tpl_vars['newsrows'] = array();
elseif (!is_array($this->_tpl_vars['newsrows'])) $this->_tpl_vars['newsrows'] = (array)$this->_tpl_vars['newsrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['newsrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['newsrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['newsrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['newsrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['newsrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['i']['order'] == 1){
echo '     
<div class="notice_left"><h6><a href="'.$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['url'].'" target="_blank" title="'.$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['title'].'">'.truncate($this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['title'],'40').'</a></h6><p></p></div>
<div class="noticeList cf"><ul>';
}else{
if($this->_tpl_vars['i']['order'] == 4 ||$this->_tpl_vars['i']['order'] == 6){
echo '<ul>';
}
echo '<li><span>'.$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['category'].'</span><em>|</em><a href="'.$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['url'].'" target="_blank" title="'.$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['title'].'">'.$this->_tpl_vars['newsrows'][$this->_tpl_vars['i']['key']]['title'].'</a></li>';
if($this->_tpl_vars['i']['order'] == 3 ||$this->_tpl_vars['i']['order'] == 5){
echo '</ul>';
}
}
}
echo '

';
?>