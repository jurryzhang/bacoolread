<?php
echo '<form name="frmsearch" method="post" action="'.$this->_tpl_vars['url_article'].'">
<table class="grid" width="100%" align="center">
    <tr>
        <td>关键字：
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50"> <input name="keytype" type="radio" class="radio" value="0" checked>小说名称
            <input type="radio" name="keytype" class="radio" value="1">作者 
			<input type="radio" name="keytype" class="radio" value="2">发表者 
            <input type="submit" name="btnsearch" class="button" value="搜 索">
            &nbsp;&nbsp;<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleper.php">全部小说</a>
			';
if (empty($this->_tpl_vars['articlepers'])) $this->_tpl_vars['articlepers'] = array();
elseif (!is_array($this->_tpl_vars['articlepers'])) $this->_tpl_vars['articlepers'] = (array)$this->_tpl_vars['articlepers'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlepers']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlepers']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlepers']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlepers']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlepers']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
			 | <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleper.php?permission='.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['i']['value'].'</a>
			';
}
echo '        
        </td>
    </tr>
</table>
</form>
<br />
<form action="'.$this->_tpl_vars['url_batchdel'].'" method="post" name="checkform" id="checkform" onSubmit="javascript:if(confirm(\'确实要批量删除小说么？\')) return true; else return false;">
<table class="grid" width="100%" align="center">
<caption>小说授权设置</caption>
  <tr align="center">
    <th width="4%">&nbsp;</th>
    <th width="14%">小说名称</th>
    <th width="10%">作者</th>
    <th width="10%">发表者</th>
    <th width="8%">更新</th>
	<th width="14%">授权状态</th>
    <th width="40%">授权设置</th>
  </tr>
  ';
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
	echo '
  <tr>
    <td align="center"><input type="checkbox" id="checkid[]" name="checkid[]" value="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"></td>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'] == 0){
echo $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'];
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/authorpage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a>';
}
echo '</td>
    <td align="center"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['posterid']).'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['poster'].'</a></td>
    <td align="center">'.date('m-d',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</td>
	<td align="center">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['permission'].'</td>
    <td align="center">
	';
if (empty($this->_tpl_vars['articlepers'])) $this->_tpl_vars['articlepers'] = array();
elseif (!is_array($this->_tpl_vars['articlepers'])) $this->_tpl_vars['articlepers'] = (array)$this->_tpl_vars['articlepers'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['articlepers']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['articlepers']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['articlepers']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['articlepers']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['articlepers']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
	';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['permission'] == $this->_tpl_vars['j']['value']){
echo $this->_tpl_vars['j']['value'];
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleper.php?action=setper&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&per='.$this->_tpl_vars['j']['key'].'">'.$this->_tpl_vars['j']['value'].'</a>';
}
echo ' 
	';
}
echo '
  </td>
  </tr>
  ';
}
echo '
  <tr>
    <td width="5%" align="center"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></td>
    <td colspan="6" align="left"><input type="submit" name="Submit" value="批量删除" class="button"><input name="batchdel" type="hidden" value="1"><input name="url_jump" type="hidden" value="'.$this->_tpl_vars['url_jump'].'"><strong></strong></td>
  </tr>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>