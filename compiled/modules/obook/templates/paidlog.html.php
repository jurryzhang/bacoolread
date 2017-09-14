<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<table width="100%" cellpadding="0" cellspacing="1" class="grid">
  <caption>收入结算记录</caption>
  <tr align="center">
    <td width="25%" class="head">电子书名</td>
    <td width="15%" class="head">结算时间</td>
    <td width="10%" class="head">总收入</td>
	<td width="10%" class="head">待结算</td>
    <td width="10%" class="head">本次结算</td>
    <td width="10%" class="head">本次未结算</td>
    <td width="10%" class="head">付款金额</td>
	<td width="10%" class="head">类型</td>
  </tr>
';
if (empty($this->_tpl_vars['paidrows'])) $this->_tpl_vars['paidrows'] = array();
elseif (!is_array($this->_tpl_vars['paidrows'])) $this->_tpl_vars['paidrows'] = (array)$this->_tpl_vars['paidrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['paidrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['paidrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['paidrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['paidrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['paidrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td><a href="'.$this->_tpl_vars['obook_dynamic_url'].'/obookinfo.php?id='.$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['obookid'].'" target="_blank">'.$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['obookname'].'</a></td>
    <td align="center">'.date('Y-m-d H:i',$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['paytime']).'</td>
    <td align="center">'.$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['sumemoney'].'</td>
	<td align="center">'.$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['paidemoney'].'</td>
    <td align="center">'.$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['payemoney'].'</td>
    <td align="center">'.$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['remainemoney'].'</td>
    <td align="center">'.$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['paymoney'].'元</td>
	<td align="center">'.$this->_tpl_vars['paidrows'][$this->_tpl_vars['i']['key']]['paidtype'].'</td>
  </tr>
';
}
echo '
</table>
'.$this->_tpl_vars['url_jumppage'].'
</div></div>

';
?>