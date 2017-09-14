<?php
echo '<form action="'.$this->_tpl_vars['jieqi_url'].'/admin/blockfiles.php?action=updatelist&module='.urlencode($this->_tpl_vars['module']).'&filename='.urlencode($this->_tpl_vars['filename']).'" method="post">
<table class="grid" width="95%" align="center">
  <caption>
  “'.$this->_tpl_vars['blockfile']['caption'].'”区块配置管理  &nbsp; [<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/blockfiles.php?action=files">返回区块配置文件列表</a>]
  </caption>
  <tr>
    <td align="center">区块名称</td>
	<td align="center">所属模块</td>
	<td align="center">显示位置</td>
	<td align="center">序号</td>
	<td align="center">区块参数</td>
    <td align="center">操作</td>
  </tr>
';
if (empty($this->_tpl_vars['blocks'])) $this->_tpl_vars['blocks'] = array();
elseif (!is_array($this->_tpl_vars['blocks'])) $this->_tpl_vars['blocks'] = (array)$this->_tpl_vars['blocks'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['blocks']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['blocks']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['blocks']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['blocks']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['blocks']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center">'.$this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['blockname'].'</td>
	<td align="center">'.$this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['modname'].'</td>
	<td align="center">
';
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==0){
echo '左边';
}
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==1){
echo '右边';
}
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==2){
echo '中左';
}
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==3){
echo '中右';
}
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==4){
echo '中上';
}
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==5){
echo '中中';
}
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==6){
echo '中下';
}
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==7){
echo '顶部';
}
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['side']==8){
echo '底部';
}
echo '	
</td>
<td align="center"><input class="text" type="text" name="key['.$this->_tpl_vars['i']['key'].']" id="key['.$this->_tpl_vars['i']['key'].']" size="4" value="'.$this->_tpl_vars['i']['key'].'" maxlength="8"></td>
<td align="center">';
if($this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['hasvars'] > 0){
echo '<input class="text" type="text" name="vars['.$this->_tpl_vars['i']['key'].']" id="vars['.$this->_tpl_vars['i']['key'].']" value="'.$this->_tpl_vars['blocks'][$this->_tpl_vars['i']['key']]['vars'].'" size="30">';
}else{
echo '无参数';
}
echo '</td>
    <td align="center"> <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/blockfiles.php?action=edit&module='.urlencode($this->_tpl_vars['module']).'&filename='.urlencode($this->_tpl_vars['filename']).'&key='.urlencode($this->_tpl_vars['i']['key']).'">修改参数</a> | <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/blockupdate.php?module='.urlencode($this->_tpl_vars['module']).'&filename='.urlencode($this->_tpl_vars['filename']).'&key='.$this->_tpl_vars['i']['key'].'" target="_blank">刷新缓存</a></td>
  </tr>
';
}
echo '
 <tr>
    <td colspan="8" align="center"><p>
      <input class="button" type="submit" name="Submit" value="批量更新参数设置">
	  <p>说明：序号为大于零的整数，不同区块不可重复。模板中调用一个区块内容用 &#123;&#63;$jieqi_pageblocks[\'XXX\'][\'content\']&#63;&#125; ，区块标题用 &#123;&#63;$jieqi_pageblocks[\'XXX\'][\'title\']&#63;&#125;，这里的XXX就是“序号”的值。</p>
    </td>
  </tr>
</table>
</form>';
?>