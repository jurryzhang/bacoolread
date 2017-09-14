<?php
echo '<table class="grid" width="100%" align="center">
<caption>章节销售记录</caption>
  <tr align="center">
    <th width="20%">书名</th>
    <th width="35%">章节</th>
    <th width="10%">价格</th>
    <th width="15%">购买人</th>
    <th width="20%">购买日期</th>
  </tr>
  ';
if (empty($this->_tpl_vars['osalerows'])) $this->_tpl_vars['osalerows'] = array();
elseif (!is_array($this->_tpl_vars['osalerows'])) $this->_tpl_vars['osalerows'] = (array)$this->_tpl_vars['osalerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['osalerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['osalerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['osalerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['osalerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['osalerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td><a href="'.$this->_tpl_vars['obook_dynamic_url'].'/obookinfo.php?id='.$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['obookid'].'" target="_blank">'.$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['obookname'].'</a></td>
    <td><a href="'.$this->_tpl_vars['obook_static_url'].'/reader.php?oid='.$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['obookid'].'&cid='.$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['ochapterid'].'" target="_blank">'.$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></td>
    <td align="center">'.$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['saleprice'].'</td>
    <td align="center"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['accountid']).'" target="_blank">'.$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['account'].'</a></td>
    <td align="center">'.date('Y-m-d H:i:s',$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['buytime']).'</td>
  </tr>
  ';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>
';
?>