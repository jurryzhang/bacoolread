<?php
echo '<br />
';
if (empty($this->_tpl_vars['forumcats'])) $this->_tpl_vars['forumcats'] = array();
elseif (!is_array($this->_tpl_vars['forumcats'])) $this->_tpl_vars['forumcats'] = (array)$this->_tpl_vars['forumcats'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['forumcats']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['forumcats']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['forumcats']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['forumcats']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['forumcats']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
<table class="grid" width="100%" align="center">
<caption>'.$this->_tpl_vars['forumcats'][$this->_tpl_vars['i']['key']]['name'].' [序号：'.$this->_tpl_vars['forumcats'][$this->_tpl_vars['i']['key']]['order'].']&nbsp; '.$this->_tpl_vars['forumcats'][$this->_tpl_vars['i']['key']]['manage'].'</caption>
    <tr align="center" class="head">
        <td width="5%">&nbsp;</td>
        <td width="50%">论坛</td>
        <td width="10%">主题数</td>
        <td width="10%">帖子数</td>
        <td width="25%">进入管理</td>
    </tr>
	';
if (empty($this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']])) $this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']] = array();
elseif (!is_array($this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']])) $this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']] = (array)$this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']]);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']]) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']]) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']]);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']]);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
    <tr>
        <td align="center" valign="middle">'.$this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['icon'].'</td>
      <td valign="middle">
		'.$this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['name'].' [序号：'.$this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['order'].'] </td>
        <td align="center" valign="middle">'.$this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['topics'].'</td>
        <td align="center" valign="middle">'.$this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['posts'].'</td>
        <td valign="middle">'.$this->_tpl_vars['forums'][$this->_tpl_vars['i']['key']][$this->_tpl_vars['j']['key']]['manage'].'</td>
    </tr>
	';
}
echo '
</table>
<br />
';
}
echo '
<br />
<br />
'.$this->_tpl_vars['forumcat_form'].'
<br />
<br />
'.$this->_tpl_vars['forum_form'].'
<br />
<br />
'.$this->_tpl_vars['union_form'].'
<br />
<br />
';
?>