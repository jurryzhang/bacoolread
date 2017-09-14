<?php
echo '<br />
<form action="link.php" method="post" name="checkform">
<table class="grid" width="100%">
<caption>友情链接列表</caption>
  <tr align="center">
    <th width="5%">&nbsp;</td>
    <th width="20%">链接标识</td>    
    <th width="15%">联系人</td>
    <th width="15%">联系方式</td>
	<th width="20%">发布时间</td>
    <th width="10%">排序</td>
    <th width="15%">操作</td>
  </tr>
  ';
if (empty($this->_tpl_vars['linkrows'])) $this->_tpl_vars['linkrows'] = array();
elseif (!is_array($this->_tpl_vars['linkrows'])) $this->_tpl_vars['linkrows'] = (array)$this->_tpl_vars['linkrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['linkrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['linkrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['linkrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['linkrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['linkrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center">'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['checkbox'].'</td>
    <td>';
if($this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['logo']!=''){
echo '<a title="'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['name'].'" target="_blank" href="'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['url'].'"><img height="33" alt="'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['name'].'" width="88" border="0" src="'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['logo'].'" /></a>';
}else{
echo '<a href="'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['url'].'" target="_blank" style="color:'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['namecolor'].'">'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['name'].'</a>';
}
echo '</td>

    <td align=center><input name="mastername'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['linkid'].'" type="text" size="16" value="'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['mastername'].'" /></td>
    <td align="center"><input name="mastertell'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['linkid'].'" type="text" size="16" value="'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['mastertell'].'" /></td>
	 <td align=center>'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['addtime'].'</td>
    <td align="center"><input name="listorder'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['linkid'].'" type="text" size="8" value="'.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['listorder'].'" /></td>
    <td align="center">
	';
if($this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['passed']<1){
echo '<a href="link.php?action=show&id='.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['linkid'].'" title="点击设为显示">显示</a>';
}else{
echo '<a href="link.php?action=hide&id='.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['linkid'].'" title="点击设为隐藏">隐藏</a>';
}
echo ' 
	<a href="addlink.php?id='.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['linkid'].'" title="点击进入详细管理页面" class="red">管理</a> 
	<a href="javascript:if(confirm(\'确实要删除该小说么？\')) document.location=\'link.php?action=del&id='.$this->_tpl_vars['linkrows'][$this->_tpl_vars['i']['key']]['linkid'].'\'">删除</a></td>
  </tr>
  ';
}
echo '
  <tr>
    <td width="5%" align="center">'.$this->_tpl_vars['checkall'].'</td>
    <td colspan="6" align="left">
	<input type="submit" name="batchdel" value="批量删除" class="button" onClick="javascript:if(confirm(\'确实要批量删除信息么？\')){ this.form.action=\'link.php?action=batchdel\'; return true; } else return false;">
	<input type="submit" name="batchchg" value="批量修改" class="button" onClick="javascript:if(confirm(\'确实要批量修改信息么？\')){ this.form.action=\'link.php?action=batchchg\'; return true; } else return false;"></td>
  </tr>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>