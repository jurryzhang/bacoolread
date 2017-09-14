<?php
echo '
<table class="grid" width="100%" align="center">
<caption>
《<a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info').'">'.$this->_tpl_vars['articlename'].'</a>》粉丝排行榜
</caption>
  <tr align="center">
    <th width="15%">排名</th>
    <th width="10%">粉丝名</th>
    <th width="10%">粉丝值</th>
	<th width="10%">等级</th>
  </tr>
  ';
if (empty($this->_tpl_vars['creditrows'])) $this->_tpl_vars['creditrows'] = array();
elseif (!is_array($this->_tpl_vars['creditrows'])) $this->_tpl_vars['creditrows'] = (array)$this->_tpl_vars['creditrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['creditrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['creditrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['creditrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['creditrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['creditrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['order'].'</td>
    <td><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['uid']).'" target="_blank">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['uname'].'</a></td>
    <td align="center">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['point'].'</td>
	<td align="center">'.$this->_tpl_vars['creditrows'][$this->_tpl_vars['i']['key']]['rank'].'</td>
  </tr>
  ';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>