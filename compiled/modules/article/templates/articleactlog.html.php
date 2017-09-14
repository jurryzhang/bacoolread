<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<table width="100%" cellpadding="0" cellspacing="1" class="grid">
  <caption>
  《'.$this->_tpl_vars['articlename'].'》';
if($this->_tpl_vars['actname'] != ''){
echo $this->_tpl_vars['actname'];
}else{
echo '互动';
}
echo '记录
  </caption>
  <tr>
    <td colspan="4" class="title">合计次数：'.$this->_tpl_vars['actlogsum']['count'].'，合计'.$this->_tpl_vars['egoldname'].'：'.$this->_tpl_vars['actlogsum']['actnum'].'</td>
  </tr>
  <tr align="center">
    <td width="40%" class="head">会员名称</td>
	<td width="20%" class="head">动作时间</td>
	<td width="20%" class="head">动作名称</td>
    <td width="20%" class="head">数量</td>
  </tr>
';
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
  <tr>
    <td><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uid']).'" target="_blank">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uname'].'</a></td>
    <td align="center">'.date('Y-m-d H:i:s',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['addtime']).'</td>
    <td align="center">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'].'</td>
    <td align="center">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'</td>
  </tr>
';
}
echo '
</table>
'.$this->_tpl_vars['url_jumppage'].'
</div></div>';
?>