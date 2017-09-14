<?php
if (empty($this->_tpl_vars['actlogrows'])) $this->_tpl_vars['actlogrows'] = array();
elseif (!is_array($this->_tpl_vars['actlogrows'])) $this->_tpl_vars['actlogrows'] = (array)$this->_tpl_vars['actlogrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['actlogrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['actlogrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['actlogrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['actlogrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['actlogrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'redrose' || $this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'yellowrose' || $this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'greenrose' || $this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'bluerose' || $this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'whiterose' || $this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'blackrose'){
echo '
				<li>
				<div class="photo">
					<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uid'],'info').'" target="_blank">
					<img style="width: 48px; height: 48px; display: inline;" sign="lazy" src="'.$this->_tpl_vars['jieqi_url'].'/avatar.php?uid='.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uid'].'" data-original="'.$this->_tpl_vars['jieqi_url'].'/images/noavatar.jpg">
					</a>
				</div>
				<div class="name">
					<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uid'],'info').'" target="_blank">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uname'].'</a>
				</div>';
if($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'redrose'){
echo '
				<div class="prop">
					<img sign="lazy" src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv01.png" data-original="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv01.png" style="display: inline;">
				</div>
				<div class="prop-num">
					X'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'
				</div>';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'yellowrose'){
echo '
				<div class="prop">
					<img sign="lazy" src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv02.png" data-original="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv02.png" style="display: inline;">
				</div>
				<div class="prop-num">
					X'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'
				</div>';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'greenrose'){
echo '
				<div class="prop">
					<img sign="lazy" src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv05.png" data-original="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv05.png" style="display: inline;">
				</div>
				<div class="prop-num">
					X'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'
				</div>';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'bluerose'){
echo '
				<div class="prop">
					<img sign="lazy" src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nv-giv01.png" data-original="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nv-giv01.png" style="display: inline;">
				</div>
				<div class="prop-num">
					X'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'
				</div>';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'whiterose'){
echo '
				<div class="prop">
					<img sign="lazy" src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv03.png" data-original="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv03.png" style="display: inline;">
				</div>
				<div class="prop-num">
					X'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'
				</div>';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'blackrose'){
echo '
				<div class="prop">
					<img sign="lazy" src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv04.png" data-original="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv04.png" style="display: inline;">
				</div>
				<div class="prop-num">
					X'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'
				</div>';
}
echo '
				</li>';
}
}

?>