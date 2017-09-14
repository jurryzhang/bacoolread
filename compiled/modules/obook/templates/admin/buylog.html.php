<?php
echo '<form name="frmsearch" action="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/buylog.php" method="get">
<table class="grid" width="100%" align="center">
  <tr>
    <td>
	<span class="hottext fr">总记录：'.$this->_tpl_vars['osalestat']['cot'].'， 总金额：'.$this->_tpl_vars['osalestat']['sumsaleprice'].'</span>
	用户名： <input name="uname" type="text" class="text" size="15" value="'.$this->_tpl_vars['_request']['uname'].'">
	小说名： <input name="aname" type="text" class="text" size="15" value="'.$this->_tpl_vars['_request']['aname'].'">
	动作日期：<input name="datestart" type="text" class="text" size="10" maxlength="10" value="'.$this->_tpl_vars['_request']['datestart'].'">-<input name="dateend" type="text" class="text" size="10" maxlength="10" value="'.$this->_tpl_vars['_request']['dateend'].'">
    <input type="submit" name="btnsearch" class="button" value="搜 索">
    <input type="hidden" name="act" value="tip">
	日期格式：2012-05-06
  </tr>
</table>
</form>
<table class="grid" width="100%" align="center">
<caption>VIP订阅记录</caption>
  <tr align="center">
    <th width="20%">小说名称</th>
    <th width="35%">章节</th>
    <th width="10%">价格</th>
    <th width="15%">用户名</th>
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
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['osalerows'][$this->_tpl_vars['i']['key']]['obookname'].'</a></td>
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