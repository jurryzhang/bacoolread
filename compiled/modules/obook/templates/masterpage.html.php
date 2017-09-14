<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<table class="grid" width="100%" align="center">
<caption>我的作品收入管理</caption>
  <tr align="center">
    <th width="23%">书名</th>
    <th width="12%">更新</th>
	<th width="10%">打赏收入</th>
<th width="5%">催更收入</th>
<th width="5%">礼品收入</th>
    <th width="10%">总收入</th>
    <th width="10%">待结算</th>
    <th width="35%">管理</th>
  </tr>
  ';
if (empty($this->_tpl_vars['obookrows'])) $this->_tpl_vars['obookrows'] = array();
elseif (!is_array($this->_tpl_vars['obookrows'])) $this->_tpl_vars['obookrows'] = (array)$this->_tpl_vars['obookrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['obookrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['obookrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['obookrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['obookrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['obookrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookname'].'</a></td>
    <td align="center">'.date('Y-m-d',$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</td>
	<td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumtip'].'</td>
<td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumhurry'].'</td>
 <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumgift'].'</td>
    <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumemoney'].'</td>
    <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['remainemoney'].'</td>
    <td align="center"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleactlog.php?id='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'].'&act=tip">打赏记录</a> <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/chapterstat.php?oid='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookid'].'">销售明细</a> <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/paidlog.php?oid='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookid'].'">结算记录</a></td>
  </tr>
  ';
}
echo '
</table>
'.$this->_tpl_vars['url_jumppage'].'
</div>
</div>

';
?>