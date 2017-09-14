<?php
if($this->_tpl_vars['ownerid'] > 0){
if (empty($this->_tpl_vars['bookcaserows'])) $this->_tpl_vars['bookcaserows'] = array();
elseif (!is_array($this->_tpl_vars['bookcaserows'])) $this->_tpl_vars['bookcaserows'] = (array)$this->_tpl_vars['bookcaserows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['bookcaserows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['bookcaserows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['bookcaserows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['bookcaserows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['bookcaserows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	          <dd>
	          	<span class="name">
	          		<a href="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank" class="f_blue4 f14">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>
	          		<a href="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_lastchapter'].'" target="_blank" class="f_gray9">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['lastchapter'].'</a>
	          	</span>
	          	<span class="status">';
if($this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['fullflag'] == 0){
echo '连载中';
}else{
echo '已完结';
}
echo '</span>
	          	<span class="date">'.date('Y-m-d h:i',$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</span>
	          	<a href="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_lastchapter'].'" class="more">立即阅读&gt;&gt;</a>
	          </dd>

  
';
}
echo '  
';
}

?>