<?php
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['i']['order'] == 1){
echo '
							<li onMouseMove="setTabin(this)" class="on">
								<h3 class="Rankh3Top">';
if($this->_tpl_vars['i']['order'] < 4){
echo '<b class="blue">';
}else{
echo '<b>';
}
echo $this->_tpl_vars['i']['order'].'</b>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</h3>
								<div >
									<div class="szimgTxt cf">
										';
if($this->_tpl_vars['i']['order'] < 4){
echo '<b class="blue">';
}else{
echo '<b>';
}
echo $this->_tpl_vars['i']['order'].'</b>
										<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank"><img src="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'" alt="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'"></a>
										<p><a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></p>                    
										<p><span>作者：</span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</p>
										<p><span>分类：</span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sort'].'</p>
										<p><span>标签：</span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['type'].'</p>
									</div>
								</div>
							</li>
					';
}else{
echo '
							<li onMouseMove="setTabin(this)">
								<h3 class="Rankh3Top">';
if($this->_tpl_vars['i']['order'] < 4){
echo '<b class="blue">';
}else{
echo '<b>';
}
echo $this->_tpl_vars['i']['order'].'</b>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</h3>
								<div  style="display:none;">
									<div class="szimgTxt cf">
										';
if($this->_tpl_vars['i']['order'] < 4){
echo '<b class="blue">';
}else{
echo '<b>';
}
echo $this->_tpl_vars['i']['order'].'</b>
										<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank"><img src="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'" alt="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'"></a>
										<p><a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></p>                    
										<p><span>作者：</span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</p>
										<p><span>分类：</span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sort'].'</p>
										<p><span>标签：</span>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['type'].'</p>
									</div>
								</div>
							</li>
					';
}
}

?>