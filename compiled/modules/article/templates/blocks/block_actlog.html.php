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
	echo '
<dd><span class="name"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uid'],'info').'" ajaxhover="true" uid="'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uid'].'" target="_blank">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uname'].'</a></span>
        		<p class="data">
        			';
if($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'tip'){
echo '
        				<span class="nm">´òÉÍ</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].' '.$this->_tpl_vars['egoldname'];
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'hurry'){
echo '<span class="nm">´ß¸ü</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].' '.$this->_tpl_vars['egoldname'];
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'vipvote'){
echo '<span class="nm"> ÔùËÍ</span> '.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].' ÕÅÔÂÆ±';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'poll'){
echo '<span class="nm">ÔùËÍ</span> '.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].' ÕÅÍÆ¼öÆ±';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'bookcase'){
echo '<span class="nm">ÊÕ²Ø</span>1´Î';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'flower'){
echo '<span class="nm">ÔùËÍ</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'¶äÏÊ»¨';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'buychapter'){
echo '<span class="nm">¶©ÔÄ</span>1ÕÂ';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'redrose'){
echo '<span class="nm">ÔùËÍ</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'¸öºì°ü';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'yellowrose'){
echo '<span class="nm">ÔùËÍ</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'±­ÃÀ¾Æ';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'greenrose'){
echo '<span class="nm">ÔùËÍ</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'¶¥¹ğ¹Ú';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'bluerose'){
echo '<span class="nm">ÔùËÍ</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'¸öÏãÄÒ';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'whiterose'){
echo '<span class="nm">ÔùËÍ</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'Ã¶×êÊ¯';
}elseif($this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'] == 'blackrose'){
echo '<span class="nm">ÔùËÍ</span>'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'Á¾³¬ÅÜ';
}
echo '
        		</p>
        	</dd>';
}

?>