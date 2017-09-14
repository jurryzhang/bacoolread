<?php
echo '
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['url_salestat'].'">
<table class="grid" width="100%" align="center">
    <tr>
      <td>关键字：
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50"> 
            <input name="keytype" type="radio" class="radio" value="0" checked="checked">书名
            <input type="radio" name="keytype" class="radio" value="1">作者 
			&nbsp;&nbsp;
            <input type="submit" name="btnsearch" class="button" value="搜 索">
        &nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>
</form>
<table class="grid" width="100%" align="center">
<caption>
<a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/salestat.php">显示全部</a>
';
if(count($this->_tpl_vars['jieqisites']) > 0){
echo '
 | <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/salestat.php?siteid=0">本站原创</a>
';
if (empty($this->_tpl_vars['jieqisites'])) $this->_tpl_vars['jieqisites'] = array();
elseif (!is_array($this->_tpl_vars['jieqisites'])) $this->_tpl_vars['jieqisites'] = (array)$this->_tpl_vars['jieqisites'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqisites']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqisites']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqisites']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqisites']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqisites']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo ' | <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/salestat.php?siteid='.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['jieqisites'][$this->_tpl_vars['i']['key']]['name'].'</a>';
}
}
echo '
</caption>
  <tr align="center">
    <th width="11%">电子书名称</th>
    <th width="8%">作者</th>
	<th width="8%">收款银行</th>
	<th width="10%">收款账号</th>
	<th width="8%">收款人</th>
    <th width="6%">订阅</th>
	<th width="6%">打赏</th>
	<th width="6%">催更</th>
    <th width="8%">总收入</th>
	<th width="8%">待结算</th>
    <th width="21%">操作</th>
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
    <td>';
if($this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['authorid'] == 0){
echo $this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['author'];
}else{
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/personmanage.php?id='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['authorid'].'" target="_blank">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['author'].'</a>';
}
echo '</td>
	<td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['banktype'].'</td>
	<td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['bankcard'].'</td>
	<td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['bankuser'].'</td>
    <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['allsale'].'</td>
	<td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumtip'].'</td>
	<td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumhurry'].'</td>
    <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumemoney'].'</td>
    <td align="center">'.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['remainemoney'].'</td>
    <td align="center"><a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/chapterstat.php?oid='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookid'].'">章节销售</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/actlog.php?aid='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'].'">打赏记录</a> | <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/paidlog.php?oid='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookid'].'">结算记录</a> | <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/paidnew.php?oid='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookid'].'">结算</a></td>
  </tr>
  ';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>