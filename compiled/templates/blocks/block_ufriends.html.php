<?php
if($this->_tpl_vars['ownerid'] > 0){
echo '
<ul class="ultop">
';
if (empty($this->_tpl_vars['friendrows'])) $this->_tpl_vars['friendrows'] = array();
elseif (!is_array($this->_tpl_vars['friendrows'])) $this->_tpl_vars['friendrows'] = (array)$this->_tpl_vars['friendrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['friendrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['friendrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['friendrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['friendrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['friendrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
<li><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['friendrows'][$this->_tpl_vars['i']['key']]['yourid']).'">'.$this->_tpl_vars['friendrows'][$this->_tpl_vars['i']['key']]['yourname'].'</a></li>
';
}
echo '
</ul>
<div class="more"><a href="'.$this->_tpl_vars['jieqi_url'].'/userfriends.php?uid='.$this->_tpl_vars['ownerid'].'" target="_blank">����...</a></div>
';
}

?>