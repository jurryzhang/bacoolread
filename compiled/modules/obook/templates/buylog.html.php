<?php
echo '
<table class="grid" width="100%" align="center">
<caption>VIP章节订阅记录</caption>
  <tr align="center">
    <th width="20%">书名</th>
    <th width="50%">章节</th>
    <th width="15%">价格</th>
    <th width="15%">购买日期</th>
  </tr>
  ';
if (empty($this->_tpl_vars['obuyinforows'])) $this->_tpl_vars['obuyinforows'] = array();
elseif (!is_array($this->_tpl_vars['obuyinforows'])) $this->_tpl_vars['obuyinforows'] = (array)$this->_tpl_vars['obuyinforows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['obuyinforows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['obuyinforows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['obuyinforows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['obuyinforows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['obuyinforows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['obuyinforows'][$this->_tpl_vars['i']['key']]['articleid'],'index').'" target="_blank">'.$this->_tpl_vars['obuyinforows'][$this->_tpl_vars['i']['key']]['obookname'].'</a></td>
    <td><a href="'.$this->_tpl_vars['obook_static_url'].'/reader.php?oid='.$this->_tpl_vars['obuyinforows'][$this->_tpl_vars['i']['key']]['obookid'].'&cid='.$this->_tpl_vars['obuyinforows'][$this->_tpl_vars['i']['key']]['ochapterid'].'" target="_blank">'.$this->_tpl_vars['obuyinforows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></td>
    <td align="center">'.$this->_tpl_vars['obuyinforows'][$this->_tpl_vars['i']['key']]['buyprice'].'</td>
    <td align="center">'.date('Y-m-d H:i',$this->_tpl_vars['obuyinforows'][$this->_tpl_vars['i']['key']]['buytime']).'</td>
  </tr>
  ';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>

';
?>