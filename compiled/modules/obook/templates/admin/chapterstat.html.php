<?php
echo '<table class="grid" width="100%" align="center">
<caption>《'.$this->_tpl_vars['obookname'].'》章节销售统计</caption>
  <tr align="center">
    <th width="30%">章节名称</th>
    <th width="13%">单价</th>
    <th width="13%">销售量</th>
    <th width="21%">总销售额</th>
    <th width="13%">状态</th>
    <th width="10%">详细记录</th>
  </tr>
';
if (empty($this->_tpl_vars['ochapterrows'])) $this->_tpl_vars['ochapterrows'] = array();
elseif (!is_array($this->_tpl_vars['ochapterrows'])) $this->_tpl_vars['ochapterrows'] = (array)$this->_tpl_vars['ochapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['ochapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['ochapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['ochapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['ochapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['ochapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td><a href="'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'" target="_blank">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></td>
    <td>'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['saleprice'].'</td>
    <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['allsale'].'</td>
    <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['sumemoney'].'</td>
    <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['display'].'</td>
    <td align="center"><a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/chapterbuylog.php?cid='.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['ochapterid'].'&oid='.$this->_tpl_vars['obookid'].'">详细记录</a></td>
  </tr>
';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>

';
?>